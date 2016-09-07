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
        $tutorials = $this->student->tutorials()->with('teacher')->orderByLatest()->get();

        return $this->frontView('tutorials.index', compact('tutorials'));
    }
}
