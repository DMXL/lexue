<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LectureController extends Controller
{
    public function index()
    {
        $lectures = authUser()->lectures()->orderByLatest()->get();

        $lectures->load('teacher');

        return frontendView('lectures.index', compact('lectures'));
    }
}
