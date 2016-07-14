<?php

namespace App\Http\Controllers\Teacher\Settings;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index()
    {
        $teacher = authUser();

        return backendView('backend.teachers.settings.index', compact('teacher'));
    }
}
