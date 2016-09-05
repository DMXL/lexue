<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Course\Lecture;

class HandleLecturesCreated extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $lecture;

    /**
     * Create a new job instance.
     *
     * @param Lecture $lecture
     */
    public function __construct(Lecture $lecture)
    {
        $this->lecture = $lecture;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
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

            \DB::table('lectures')
                ->where('id', $this->lecture->id)
                ->update(['room_id' => $roomId, 'host_code' => $hostCode]);

            $this->openWechatLive($roomId);
        }
    }

    /**
     * Send wechat live opening request to Duobei.
     *
     * @param $roomId
     */
    private function openWechatLive($roomId)
    {
        $teacherName = $this->lecture->teacher->name;
        $teacherBrief = $this->lecture->teacher->description;
        $description =  $this->lecture->description;

        $result = json_decode(\Duobeiyun::openWeixinLive($roomId, $teacherName, $teacherBrief, $description), true);
        if ($result['success']) {
            \DB::table('lectures')
                ->where('id', $this->lecture->id)
                ->update(['wechat_room_id' => $result['course']['roomId']]);
        }
    }

}