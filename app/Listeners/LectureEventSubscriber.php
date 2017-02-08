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

use Carbon\Carbon;
use App\Models\Course\Lecture;
use App\Models\Course\Order;
use App\Models\Course\Schedule;
use App\Events\LectureCreated;
use App\Events\LecturePurchased;

class LectureEventSubscriber
{
    /**
     * Handle the LectureCreated event.
     *
     * @param LectureCreated $event
     */
    public function onLectureCreated(LectureCreated $event)
    {
        $this->createRoom($event->lecture);
    }

    /**
     * Handle the LecturePurchased event.
     *
     * @param LecturePurchased $event
     */
    public function onLecturePurchased(LecturePurchased $event)
    {
        $order = $event->order;
        $this->assignSchedules($order);
        $this->pushLectureConfirmation($order);
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
     * Assign schedules to the schedules table.
     *
     * @param Order $order
     */
    public function assignSchedules(Order $order)
    {
        if($order->is_lecture)
        {
            $lecture = $order->lecture;

            $schedule = new Schedule([
                'student_id'  => $lecture->student_id,
                'teacher_id'  => $lecture->teacher_id,
                'course_id'   => $lecture->id,
                'course_type' => 'lecture',
                'date'        => $lecture->date,
                'start'       => $lecture->start,
                'end'         => $lecture->end_time->toTimeString()
            ]);

            $schedule->save();
        } else
        {
            $tutorials = $order->tutorials;

            foreach($tutorials as $tutorial)
            {
                $schedule = new Schedule([
                    'student_id'  => $tutorial->student_id,
                    'teacher_id'  => $tutorial->teacher_id,
                    'course_id'   => $tutorial->id,
                    'course_type' => 'tutorial',
                    'date'        => $tutorial->date,
                    'start'       => $tutorial->time_slot->star,
                    'end'         => $tutorial->time_slot->end
                ]);

                $schedule->save();
            }
        }
    }

    /**
     * Push Wechat notification to user.
     *
     * @param Order $order
     * @return bool
     */
    public function pushLectureConfirmation(Order $order)
    {
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
            'url'         => route('m.students::lectures.index')."#tab3",
            'topcolor'    => '#000000',
            'data'        => [
                "first"      => [
                    "value" => "亲爱的 " . $student->name . "，您已成功购买课程。\n",
                    "color" => "#000000"
                ],
                "keyword1"   => [
                    "value" => $teacher->name . " 老师的直播课 " . $lecture->name,    // 课程名称
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
        $teacherBrief = $lecture->teacher->description;
        $description = $lecture->description;

        $result = json_decode(\Duobeiyun::openWeixinLive($roomId, $teacherName, $teacherBrief, $description), true);
        if ($result['success']) {
            return true;
        } else return false;
    }
}
