<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course\Lecture;
use App\Models\Course\Order;
use Carbon\Carbon;
use DB;

class LectureController extends Controller
{
    /**
     * @var \App\Models\User\Student
     */
    private $student;

    /**
     * @var array
     */
    private $orderList;

    /**
     * LectureController constructor.
     */
    public function __construct()
    {
        $this->student = authUser();
    }

    public function index()
    {
        $lectures = Lecture::enabled()
            ->unfinished()
            ->orderByEarliest()
            ->with('teacher')
            ->get();

        $upcoming = collect();
        $ongoing = collect();

        foreach ($lectures as $lecture) {
            if ($lecture->isLive()) {
                $ongoing->prepend($lecture);
            } else {
                $upcoming->push($lecture);
            }
        }

        $count = $ongoing->count();

        $userLectures = $this->student->lectures;
        $userLecturesList = $this->getOrderList();

        return $this->frontView('wechat.lectures.index', compact('upcoming', 'ongoing', 'count', 'userLectures', 'userLecturesList'));
    }

    public function show(Lecture $lecture)
    {
        $isPurchased = null;

        if(array_key_exists($lecture->id, $this->getOrderList()))
            $isPurchased = $this->getOrderList()[$lecture->id];

        return $this->frontView('wechat.lectures.show', compact('lecture', 'isPurchased'));
    }

    public function showRoom($lectureId)
    {
        $lecture = Lecture::findOrFail($lectureId);
        $order = $this->student->orders()->where('lecture_id', $lectureId)->first();

        if ($order) {
            if ($order->paid) {
                $roomId = $lecture->room_id;
                return $this->frontView('wechat.lectures.room', compact('roomId'));
            }
        }

        flash()->error('抱歉，您还未购买该课程');
        return redirect()->route('m.students::lectures.show', $lectureId);
    }

    public function book($lectureId)
    {
        $lecture = Lecture::findOrFail($lectureId);

        try {
            $orderId = DB::transaction(function() use ($lecture) {
                $student = authUser();

                /*
                 * create order and schedule
                 */
                $order = new Order();
                $order->trade_no = generateTradeNo();
                $order->student_id = $student->id;
                $order->teacher_id = $lecture->teacher->id;
                $order->lecture_id = $lecture->id;
                $order->is_lecture = true; // @TODO 考虑删除
                $order->total = $lecture->price;
                $order->paid = false;
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
        $lectures = Lecture::enabled()
            ->finished()
            ->with('teacher')
            ->get();

        $userLecturesList = $this->getOrderList();

        return $this->frontView('wechat.lectures.replays', compact('lectures', 'userLecturesList'));
    }

    private function getOrderList()
    {
        if (!$this->orderList) {
            $this->orderList = $this->student->lectures()->pluck('paid', 'lecture_id')->toArray();
        }

        return $this->orderList;
    }
}
