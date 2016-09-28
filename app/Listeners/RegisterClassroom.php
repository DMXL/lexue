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
 * Filename->CreateClassroom.php
 * Project->lexue
 * Description->The listener for LectureCreated event.
 *
 * Created by DM on 16/9/28 下午12:47.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
 */
namespace App\Listeners;

use App\Events\LectureCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterClassroom
{
    private $lecture;

    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param LectureCreated $event
     */
    public function handle(LectureCreated $event)
    {
        $this->lecture = $event->lecture;
        $this->createRoom();
    }

    /**
     * Send room creating request to Duobei.
     *
     */
    private function createRoom()
    {
        $title = $this->lecture->name;
        $startTime = $this->lecture->timestamp;
        $length = $this->lecture->length;
        $video = 1;
        $roomType = 2;

        $result = json_decode(\Duobeiyun::createRoom2($title, $startTime, $length, $video, $roomType), true);
        if ($result['success']) {
            $roomId = $result['room']['roomId'];
            $hostCode = $result['room']['hostCode'];
            if ($this->openWechatLive($roomId)) {
                $this->lecture->room_id = $roomId;
                $this->lecture->host_code = $hostCode;
                $this->lecture->save();
            }
        }
    }

    /**
     * Send wechat live opening request to Duobei.
     *
     * @param $roomId
     * @return boolean
     */
    private function openWechatLive($roomId)
    {
        $teacherName = $this->lecture->teacher->name;
        $teacherBrief = 'This is still being tested.'; // $this->lecture->teacher->description;
        $description = $this->lecture->description;

        $result = json_decode(\Duobeiyun::openWeixinLive($roomId, $teacherName, $teacherBrief, $description), true);
        if ($result['success']) {
            return true;
        } else return false;
    }
}
