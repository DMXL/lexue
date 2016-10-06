<?php

namespace App\Http\Controllers\Student;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TutorialController extends Controller
{
    private $student;

    /**
     * TutorialController constructor.
     */
    public function __construct()
    {
        $this->student = authUser();
    }

    public function index()
    {
        $raw = $this->student->tutorials()->with('teacher');
        $tutorialsDesc = $raw->orderByLatest()->get();
        $tutorialsAsc = $raw->orderByEarliest()->get();

        $upcoming = $tutorialsAsc->filter(function($tutorial) {
            $startTime = $tutorial->date.' '.$tutorial->start;

            return $startTime >= Carbon::now();
        });

        $ongoing = $tutorialsDesc->filter(function($tutorial) {
            $startTime = $tutorial->date.' '.$tutorial->start;
            $endTime = $tutorial->date.' '.$tutorial->timeSlot->end;

            return ($startTime < Carbon::now() && $endTime >= Carbon::now());
        });

        $finished = $tutorialsDesc->filter(function($tutorial) {
            $endTime = $tutorial->date.' '.$tutorial->timeSlot->end;

            return $endTime < Carbon::now();
        });

        return $this->frontView('tutorials.index', compact('upcoming', 'ongoing', 'finished'));
    }
}
