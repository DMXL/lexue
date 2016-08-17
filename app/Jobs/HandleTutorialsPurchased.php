<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Models\Course\Lecture;
use App\Models\Course\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleTutorialsPurchased extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var null|array
     */
    private $orderId;

    /**
     * Create a new job instance.
     * @param
     */
    public function __construct($orderId = null)
    {
        $this->orderId = $orderId;
    }

    /**
     * Execute the job.
     *
     * @return void
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

        /** @var \Illuminate\Support\Collection $lectures */
        $tutorials = $order->tutorials;

        $sampleLecture = $tutorials->first();

        $student = $sampleLecture->student;
        $teacher = $sampleLecture->teacher;

        if (! $student->wechat_id) {
            \Log::error('student with id ' . $student->id . ' has no wechat_id.');
            return false;
        }

        $message = [
            'touser'      => $student->wechat_id,
            'template_id' => config('wechat.template.purchase_success'),
            'url'         => route('m.students::lectures.index'),
            'topcolor'    => '#00f7f7',
            'data'        => [
                "first"      => "亲爱的 " . $student->name . "，您已成功购买课程。",
                "keyword1"   => $teacher->name . " 老师的一对一微信课程",    // 课程名称
                "keyword2"   => $order->total . "元",    // 支付金额
                "keyword3"   => $tutorials->pluck('human_date_time')->implode(', '),    // 课程时间
                "remark"     => "随后乐学云教学主管老师将第一时间与您取得联系，请您及时关注微信消息！"
            ],
        ];

        \WechatPusher::push($message);
    }
}
