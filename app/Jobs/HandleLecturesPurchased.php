<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Course\Lecture;
use App\Models\Course\Order;

class HandleLecturesPurchased extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var null|array
     */
    private $orderId;


    /**
     * Create a new job instance.
     *
     * @param $orderId
     */
    public function __construct($orderId = null)
    {
        $this->orderId = $orderId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if (isset($this->orderId)) {
            $this->notify($this->orderId);
        }
    }

    /**
     * 发送购买成功模板消息
     * @param array $orderId
     * @return bool
     */
    private function notify($orderId)
    {
        $order = Order::find($orderId);

        $lecture = $order->lecture;

        $student = $order->student;
        $teacher = $lecture->teacher;

        if (! $student->wechat_id) {
            \Log::error('student with id ' . $student->id . ' has no wechat_id.');
            return false;
        }

        $message = [
            'touser'      => $student->wechat_id,
            'template_id' => config('wechat.template.purchase_success'),
            'url'         => route('m.students::orders.index'),
            'topcolor'    => '#000000',
            'data'        => [
                "first"      => [
                    "value" => "亲爱的 " . $student->name . "，您已成功购买课程。\n",
                    "color" => "#000000"
                ],
                "keyword1"   => [
                    "value" => $teacher->name . " 老师的公开课 " . $lecture->name,    // 课程名称
                    "color" => "#00beb7"
                ],
                "keyword2"   => [
                    "value" => number_format($order->total, 2) . "元",    // 支付金额
                    "color" => "#00beb7"
                ],
                "keyword3"   => [
                    "value" => $lecture->date_time,    // 课程时间
                    "color" => "#00beb7"
                ],
                "remark"   => [
                    "value" => "请按时进入教室上课，不要迟到哦！",
                    "color" => "#000000"
                ]
            ]
        ];

        \WechatPusher::push($message);
    }
}
