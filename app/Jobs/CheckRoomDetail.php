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
        $endTime = Carbon::createFromFormat('Y-m-d H:i:s', $detail['course']['endTime']);

        if(Carbon::now() >= $endTime)
        {
            $this->lecture->length = $endTime->diffInMinutes($this->lecture->start_time);
            $this->lecture->finished = 1;
            $this->lecture->save();
        }
    }
}
