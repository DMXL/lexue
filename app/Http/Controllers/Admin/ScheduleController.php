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
 * Filename->ScheduleController.php
 * Project->lexue
 * Description->
 *
 * Created by DM on 2017/2/9 下午4:49.
 * Copyright 2017 Team Sudo. All rights reserved.
 *
 */

namespace App\Http\Controllers\Admin;

use App\Models\Course\Schedule;
use App\Models\User\Teacher;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dailySchedules = Schedule::orderByEarliest()->withinCurrentWeek()->get()->groupBy('date');

        return $this->backView('backend.admins.schedules.index', compact('dailySchedules'));
    }

    /**
     * Display schedules that belong to a certain teacher.
     *
     * @param int  $teacherId
     * @return \Illuminate\Http\Response
     */
    public function showTeacher($teacherId)
    {
        $teacher = Teacher::find($teacherId);
        $dailySchedules = $teacher->schedules()->orderByEarliest()->withinCurrentWeek()->get()->groupBy('date');

        return $this->backView('backend.admins.teachers.schedules', compact('dailySchedules'));
    }
}