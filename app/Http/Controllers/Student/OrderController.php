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
            $startTime = $lecture->date.' '.$lecture->start;

            return $startTime >= Carbon::now();
        });

        $ongoing = $lecturesDesc->filter(function($lecture) {
            $startTime = $lecture->date.' '.$lecture->start;
            $endTime = Carbon::createFromFormat('Y-m-d H:i:s', $startTime)->addMinutes($lecture->length);

            return ($startTime < Carbon::now() && $endTime >= Carbon::now());
        });

        $finished = $lecturesDesc->filter(function($lecture) {
            $startTime = $lecture->date.' '.$lecture->start;
            $endTime = Carbon::createFromFormat('Y-m-d H:i:s', $startTime)->addMinutes($lecture->length);

            return $endTime < Carbon::now();
        });

        return $this->frontView('wechat.orders.index', compact('upcoming', 'ongoing', 'finished'));
    }

    public function show()
    {
        //
    }
}
