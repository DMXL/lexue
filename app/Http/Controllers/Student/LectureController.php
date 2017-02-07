<?php

namespace App\Http\Controllers\Student;

use App\Events\LecturePurchased;
use App\Http\Controllers\Controller;
use App\Models\Course\Lecture;
use App\Models\Course\Order;
use Carbon\Carbon;

class LectureController extends Controller
{
    private $student;
    private $orderList;

    /**
     * LectureController constructor.
     */
    public function __construct()
    {
        $this->student = authUser();
        $this->orderList = $this->student->lectures()->pluck('paid', 'lecture_id')->toArray();
    }

    public function index()
    {
        $lectures = Lecture::orderByEarliest()
            ->with('teacher')
            ->get();

        $upcoming = $lectures->filter(function($lecture) {
            return $lecture->start_time >= Carbon::now();
        });

        $ongoing = $lectures->filter(function($lecture) {
            return ($lecture->start_time < Carbon::now() && $lecture->end_time >= Carbon::now());
        });

        $userLectures = $this->student->lectures;

        $count = $ongoing->filter(function($lecture) {
            return $lecture->enabled;
        })->count();

        $userLecturesList = $this->orderList;

        $now = Carbon::now();

        return $this->frontView('wechat.lectures.index', compact('upcoming', 'ongoing', 'userLectures', 'count', 'userLecturesList', 'now'));
    }

    public function show($id)
    {
        $lecture = Lecture::find($id);
        $isPurchased = null;

        if(array_key_exists($id, $this->orderList))
            $isPurchased = $this->orderList[$id];

        return $this->frontView('wechat.lectures.show', compact('lecture', 'isPurchased'));
    }

    public function book($lectureId)
    {
        $lecture = Lecture::find($lectureId);

        try {
            $orderId = \DB::transaction(function() use ($lecture) {
                $student = authUser();

                /*
                 * create order
                 */
                $order = new Order();
                $order->trade_no = generateTradeNo();
                $order->student_id = $student->id;
                $order->teacher_id = $lecture->teacher->id;
                $order->lecture_id = $lecture->id;
                $order->is_lecture = 1; // @TODO 考虑删除
                $order->total = $lecture->price;
                $order->paid = 0;
                $order->save();

                return $order->id;
            });
        } catch (\Exception $e) {
            $this->handleException($e);
            flash()->error('系统错误，请稍等片刻');
            return back();
        }

        return redirect()->route('m.students::orders.pay', $orderId);
    }

    public function replays()
    {
        $lectures = Lecture::finished()
            ->with('teacher')
            ->get();

        $userLecturesList = $this->orderList;

        return $this->frontView('wechat.lectures.replays', compact('lectures', 'userLecturesList'));
    }
}
