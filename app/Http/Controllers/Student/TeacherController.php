<?php

namespace App\Http\Controllers\Student;

use App\Models\User\Teacher;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();

        return view('frontend.teachers.index', compact('teachers'));
    }

    public function show($id)
    {
        return Teacher::find($id);
    }
}
