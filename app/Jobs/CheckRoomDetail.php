<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Course\Lecture;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckRoomDetail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $lecture;

    /**
     * Create a new job instance.
     *
     * @param Lecture $lecture
     * @return void
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
        $detail = json_decode(\Duobeiyun::getRoomDetail($this->lecture->room_id), true);
        $endTime = Carbon::parse($detail['course']['endTime']);

        if($endTime->isPast()) // 课程已结束
        {
            $this->lecture->length = $endTime->diffInMinutes($this->lecture->start_time);
            $this->lecture->finished = true;
            $this->lecture->save();
        }
    }

    /**
     * Handle a job failure.
     *
     * @return void
     */
    public function failed()
    {
        // Called when the job is failing...
    }
}
