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
 * Filename->LectureEventListener.php
 * Project->lexue
 * Description->The listener for lecture events.
 *
 * Created by DM on 16/9/28 下午12:47.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
 */
namespace App\Listeners;

use App\Models\Course\Lecture;
use App\Events\LectureCreated;
use App\Events\LecturePurchased;

class LectureEventSubscriber
{
    /**
     * Handle the LectureCreated event.
     *
     * @param LectureCreated $event
     */
    public function registerClassroom(LectureCreated $event)
    {
        $this->createRoom($event->lecture);
    }

    /**
     * Handle the LecturePurchased event.
     *
     * @param LecturePurchased $event
     * @return bool
     */
    public function pushLectureConfirmation(LecturePurchased $event)
    {
        $order = $event->order;

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
                    "value" => $lecture->start_time->toDateTimeString(),    // 课程时间
                    "color" => "#00beb7"
                ],
                "remark"   => [
                    "value" => "\n请按时进入教室上课，不要迟到哦！",
                    "color" => "#000000"
                ]
            ]
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
            'App\Events\LectureCreated',
            'App\Listeners\LectureEventSubscriber@registerClassroom'
        );

        $events->listen(
            'App\Events\LecturePurchased',
            'App\Listeners\LectureEventSubscriber@pushLectureConfirmation'
        );
    }

    /**
     * Send room creating request to Duobei.
     *
     * @param Lecture $lecture
     */
    private function createRoom(Lecture $lecture)
    {
        $title = $lecture->name;
        $startTime = $lecture->timestamp;
        $length = $lecture->length;
        $video = 1;
        $roomType = 2;

        $result = json_decode(\Duobeiyun::createRoom2($title, $startTime, $length, $video, $roomType), true);
        if ($result['success']) {
            $roomId = $result['room']['roomId'];
            $hostCode = $result['room']['hostCode'];
            if ($this->openWechatLive($lecture, $roomId)) {
                $lecture->room_id = $roomId;
                $lecture->host_code = $hostCode;
                $lecture->save();
            }
        }
    }

    /**
     * Send wechat live opening request to Duobei.
     *
     * @param Lecture $lecture
     * @param $roomId
     * @return boolean
     */
    private function openWechatLive(Lecture $lecture, $roomId)
    {
        $teacherName = $lecture->teacher->name;
        $teacherBrief = 'This is still being tested.'; // $lecture->teacher->description;
        $description = $lecture->description;

        $result = json_decode(\Duobeiyun::openWeixinLive($roomId, $teacherName, $teacherBrief, $description), true);
        if ($result['success']) {
            return true;
        } else return false;
    }
}
