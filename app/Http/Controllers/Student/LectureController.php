<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course\Lecture;

class LectureController extends Controller
{
    private $student;

    /**
     * LectureController constructor.
     */
    public function __construct()
    {
        $this->student = authUser();
    }

    public function index()
    {
        $lectures = Lecture::orderByLatest()->with('teacher')->paginate();

        return $this->frontView('lectures.index', compact('lectures'));
    }
}
