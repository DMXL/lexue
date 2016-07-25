<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Models\Course\Lecture;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleLecturesPurchased extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var null|array
     */
    private $lectureIds;

    /**
     * Create a new job instance.
     * @param
     */
    public function __construct($lectureIds = null)
    {
        $this->lectureIds = $lectureIds;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (isset($this->lectureIds)) {
            $this->notify($this->lectureIds);
        }
    }

    /**
     * 发送购买成功模板消息
     * @param array $lectureIds
     * @return bool
     */
    public function notify($lectureIds)
    {
        /** @var \Illuminate\Support\Collection $lectures */
        $lectures = Lecture::whereIn('id', $lectureIds)->get();

        $sampleLecture = $lectures->first();

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
            'topcolor'    => '#f7f7f7',
            'data'        => [
                "first"      => "亲爱的 " . $student->name . "，您已成功购买课程。",
                "keyword1"   => $teacher->name . " 老师的一对一微信课程",    // 课程名称
                "keyword2"   => number_format($teacher->unit_price, 2) . "元",    // 支付金额
                "keyword3"   => $lectures->pluck('human_date_time')->implode(', '),    // 课程时间
                "remark"     => "随后乐学云教学主管老师将第一时间与您取得联系，请您及时关注微信消息！"
            ],
        ];

        \WechatPusher::push($message);
    }
}
