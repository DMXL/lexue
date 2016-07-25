<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Auth\WechatAuthController;
use App\Models\Course\Lecture;
use App\Models\User\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WechatController;

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

        /*
         * create lecture
         */
        try {
            \DB::transaction(function() use ($bookTimes, $teacherId) {
                $studentId = authId();
                foreach ($bookTimes as $bookTime) {
                    $values = explode('--', $bookTime);
                    $lecture = new Lecture();
                    $lecture->date = $values[0];
                    $lecture->time_slot_id = $values[1];
                    $lecture->student_id = $studentId;
                    $lecture->teacher_id = $teacherId;
                    $lecture->single = true;
                    $lecture->save();
                }
            });
        } catch (\Exception $e) {
            $this->handleException($e);
            flash()->error('系统错误……我们将手动添加课程，请稍等片刻');
            return back();
        }

        flash()->success('课程添加成功');

        dd(config('wechat.template.purchase_success'));

        /*
         * send the success message to student's Wechat
         */
        $timeString = '';
        foreach ($bookTimes as $bookTime) {
            $values = explode('--', $bookTime);
            $timeString .= $values[0].' '.$values[1];
        }

        $wechat = new WechatController();
        $wechat->sendSuccess([
            'student_id' => authUser()->wechat_id,
            'student_name' => authUser()->name,
            'teacher_name' => $teacher->name,
            'price' => ( count($bookTimes) *  $teacher->unit_price ),
            'time' => $timeString
        ]);

        return $this->frontRedirect('students::lectures.index');
    }
}
