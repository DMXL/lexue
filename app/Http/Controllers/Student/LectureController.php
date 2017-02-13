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
            ->orderByEarliest()
            ->with('teacher')
            ->get();

        $upcoming = collect();
        $ongoing = collect();

        foreach ($lectures as $lecture) {
            if ($lecture->isComing()) {
                $upcoming->push($lecture);
            }
            elseif ($lecture->isLive()) {
                $ongoing->prepend($lecture);
            }
        }

        $count = $ongoing->count();

        $userLectures = $this->student->lectures;
        $userLecturesList = $this->getOrderList();

        return $this->frontView('wechat.lectures.index', compact('upcoming', 'ongoing', 'count', 'userLectures', 'userLecturesList'));
    }

    public function show($id)
    {
        $lecture = Lecture::find($id);
        $isPurchased = null;

        if(array_key_exists($id, $this->getOrderList()))
            $isPurchased = $this->getOrderList()[$id];

        return $this->frontView('wechat.lectures.show', compact('lecture', 'isPurchased'));
    }

    public function book($lectureId)
    {
        $lecture = Lecture::find($lectureId);

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
