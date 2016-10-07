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
            return $tutorial->start_time >= Carbon::now();
        });

        $ongoing = $tutorialsDesc->filter(function($tutorial) {
            return ($tutorial->start_time < Carbon::now() && $tutorial->end_time >= Carbon::now());
        });

        $finished = $tutorialsDesc->filter(function($tutorial) {
            return $tutorial->end_time < Carbon::now();
        });

        return $this->frontView('tutorials.index', compact('upcoming', 'ongoing', 'finished'));
    }
}
