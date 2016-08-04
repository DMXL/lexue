<?php

namespace App\Http\Controllers\Student;

use App\Models\Course\Lecture;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OpenLectureController extends Controller
{
    public function index()
    {
        $lectures = Lecture::where('single', 0)->orderBy('start','desc')->paginate();

        return $this->frontView('openlectures.index', compact('lectures'));
    }
}
