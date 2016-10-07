<?php

namespace App\Http\Controllers\Student;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    private $student;

    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->student = authUser();
    }

    public function index()
    {
        $raw = $this->student->lectures();
        $lecturesDesc = $raw->orderByLatest()->get();
        $lecturesAsc = $raw->orderByEarliest()->get();

        $upcoming = $lecturesAsc->filter(function($lecture) {
            return $lecture->start_time >= Carbon::now();
        });

        $ongoing = $lecturesDesc->filter(function($lecture) {
            return ($lecture->start_time < Carbon::now() && $lecture->end_time >= Carbon::now());
        });

        $finished = $lecturesDesc->filter(function($lecture) {
            return $lecture->end_time < Carbon::now();
        });

        return $this->frontView('wechat.orders.index', compact('upcoming', 'ongoing', 'finished'));
    }

    public function show()
    {
        //
    }
}
