<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TutorialController extends Controller
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
        $singleLectures = $this->student->singleLectures()->with('teacher')->get();
        $multiLectures = $this->student->multiLectures()->with('teacher')->get();

        $lectures = $singleLectures->merge($multiLectures)->sortByDesc('start')->sortByDesc('date');

        return $this->frontView('lectures.index', compact('lectures'));
    }
}
