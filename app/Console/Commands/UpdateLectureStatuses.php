<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Course\Lecture;
use App\Jobs\CheckRoomDetail;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;

class UpdateLectureStatuses extends Command
{
    use DispatchesJobs;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lecture-statuses:update {lecture? : The id of the lecture}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update statuses of all lectures or lecture with a certain room id.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lectureId = $this->argument('lecture');

        if(isset($lectureId))
        {
            $this->info('This works, lecture id is '.$lectureId.'.');
        } else
        {
            $lectures = Lecture::unfinished()->get();
            $count = 0;

            foreach($lectures as $lecture) {
                if($lecture->start_time->isPast()) {
                    $this->dispatch(new CheckRoomDetail($lecture));
                    $count++;
                }
            }

            if($count > 0) {
                $this->info('['.Carbon::now()->toDateTimeString().'] tasks.INFO: '.$count.' '.($count == 1 ? 'lecture is' : 'lectures are').' being watched.');
            }
        }
    }
}
