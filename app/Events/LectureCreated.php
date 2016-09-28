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
 * Filename->LectureCreated.php
 * Project->lexue
 * Description->The event fired after a lecture is created.
 *
 * Created by DM on 16/9/28 上午11:41.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
 */
namespace App\Events;

use App\Models\Course\Lecture;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LectureCreated extends Event
{
    use SerializesModels;

    public $lecture;

    /**
     * Create a new event instance.
     *
     * @param Lecture $lecture
     */
    public function __construct(Lecture $lecture)
    {
        $this->lecture = $lecture;
    }
}
