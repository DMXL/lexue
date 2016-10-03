<?php
/**
 *
 *
 *   ______                        _____           __
 *  /_  __/__  ____ _____ ___     / ___/__  ______/ /___
 *   / / / _ \/ __ `/ __ `__ \    \__ \/ / / / __  / __ \
 *  / / /  __/ /_/ / / / / / /   ___/ / /_/ / /_/ / /_/ /
 * /_/  \___/\__,_/_/ /_/ /_/   /____/\__,_/\__,_/\____/
 *
 *
 *
 * Filename->TutorialEventListener.php
 * Project->lexue
 * Description->The listener for tutorial events.
 *
 * Created by DM on 16/10/2 下午10:29.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
 */
namespace App\Listeners;

use App\Events\TutorialPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TutorialEventListener implements ShouldQueue
{
    /**
     * Handle the TutorialPurchased event.
     *
     * @param TutorialPurchased $event
     * @return bool
     */
    public function pushTutorialConfirmation(TutorialPurchased $event)
    {
        $order = $event->order;
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

    /**
     * Register the listeners for the subscriber.
     *
     * @param $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\TutorialPurchased',
            'App\Listeners\TutorialEventListener@pushTutorialConfirmation'
        );
    }
}