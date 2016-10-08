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
    private $purchased;

    /**
     * LectureController constructor.
     */
    public function __construct()
    {
        $this->student = authUser();
        $this->purchased = $this->student->lectures()->pluck('orders.paid', 'lectures.id')->toArray();
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

        $count = $ongoing->count();

        $purchased = $this->purchased;

        return $this->frontView('lectures.index', compact('upcoming', 'ongoing', 'count', 'purchased'));
    }

    public function show($id)
    {
        $lecture = Lecture::find($id);
        $isPurchased = null;

        if(array_key_exists($id, $this->purchased))
            $isPurchased = $this->purchased[$id];


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
                $order->student_id = $student->id;
                $order->teacher_id = $lecture->teacher->id;
                $order->lecture_id = $lecture->id;
                $order->is_lecture = 1; // @TODO 考虑删除
                $order->total = $lecture->price;
                $order->paid = 0; // @TODO 支付API对接完毕后删除此处
                $order->save();

                return $order->id;
            });
        } catch (\Exception $e) {
            $this->handleException($e);
            flash()->error('系统错误，请稍等片刻');
            return back();
        }

        return redirect()->route('m.students::orders.pay', $orderId);

        // event(new LecturePurchased($order));
        // flash()->success('课程添加成功');

        // return $this->frontRedirect('m.students::orders.index');
    }
}
