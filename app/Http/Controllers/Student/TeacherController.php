<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Jobs\HandleLecturesPurchased;
use App\Models\Course\Lecture;
use App\Models\Course\Order;
use App\Models\User\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();

        return $this->frontView('frontend.teachers.index', compact('teachers'));
    }

    public function show($id)
    {
        /** @var \App\Models\User\Teacher $teacher */
        $teacher = Teacher::find($id);

        $timetable = $teacher->getTimetable();

        return $this->frontView('frontend.teachers.show', compact('teacher', 'timetable'));
    }

    /**
     * Accept a booking from the student
     *
     * @param Request $request
     * @param $teacherId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function book(Request $request, $teacherId)
    {
        $this->validate($request, [
            'times' => 'required',
            'times.*' => 'regex:/\d{4}-\d{2}-\d{2}--\d+/'
        ],[
            'times.required' => '请选择课时',
            'times.*.regex' => '课时格式有误'
        ]);

        /** @var \App\Models\User\Teacher $teacher */
        $teacher = Teacher::find($teacherId);

        $unavailabilities = $teacher->getUnavailabilities();

        $bookTimes = $request->input('times');

        /* in case concatenated values are mixed in */
        $bookTimes = collect($bookTimes)
            ->transform(function ($item) {
                return explode(',', $item);
            })
            ->flatten()
            ->reject(function ($value) {
                return !$value;
            });

        /*
         * sanitize and validate the times
         */
        foreach ($bookTimes as $bookTime) {
            $dateString = explode('--', $bookTime)[0];
            $bookDate = Carbon::parse($dateString);
            /* check if requested time is valid */
            if ($bookDate < Carbon::tomorrow()
                OR $bookTime > Carbon::tomorrow()->addDays(config('course.days_to_show'))) {
                \Flash::error('选择的日期无效');
                return back();
            }

            /* check if requested time is available */
            if (in_array($bookTime, $unavailabilities)) {
                \Flash::error('手慢了！ <b>' . humanDateTime($dateString) . '</b>已被占用');
                return back();
            }
        }

        try {
            $orderId = \DB::transaction(function() use ($bookTimes, $teacher) {
                $student = authUser();

                /*
                 * create order
                 */
                $order = new Order();
                $order->student_id = $student->id;
                // TODO calculate based on lecture price with teacher unit price as a fallback
                $order->total = count($bookTimes) * $teacher->unit_price;
                $order->save();

                /*
                 * create lectures
                 */
                $lectureIds = [];
                foreach ($bookTimes as $bookTime) {
                    $values = explode('--', $bookTime);
                    $lecture = new Lecture();
                    $lecture->date = $values[0];
                    $lecture->time_slot_id = $values[1];
                    $lecture->student_id = $student->id;
                    $lecture->teacher_id = $teacher->id;
                    $lecture->single = true;
                    $lecture->save();

                    // stack new lecture's id
                    $lectureIds[] = $lecture->getAttribute('id');
                }

                /*
                 * associate lectures with order
                 */
                $order->lectures()->sync($lectureIds);

                return $order->id;
            });
        } catch (\Exception $e) {
            $this->handleException($e);
            flash()->error('系统错误……我们将手动添加课程，请稍等片刻');
            return back();
        }

        $this->dispatch(new HandleLecturesPurchased($orderId));

        flash()->success('课程添加成功');

        return $this->frontRedirect('students::lectures.index');
    }
}
