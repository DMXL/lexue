<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleLecturesCreated extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $lectureId;

    /**
     * Create a new job instance.
     *
     * @param null $lectureId
     */
    public function __construct($lectureId = null)
    {
        $this->lectureId = $lectureId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (isset($this->orderId)) {
            $this->createRoom($this->orderId);
        }
    }

    /**
     * Send room creating request to Duobei.
     *
     * @param $lectureId
     * @return mixed
     */
    private function createRoom($lectureId)
    {
        $lecture = Lecture::find($lectureId);

        $title = $lecture->name;
        $startTime = $lecture->date_time;
        $length = $lecture->length;
        $video = 1;
        $roomType = 2;

        return \Duobeiyun::createRoom2($title, $startTime, $length, $video, $roomType);
    }
}
