<?php

namespace App\Http\Controllers\Teacher\Settings;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function edit()
    {
        $teacher = authUser();

        return view('backend.teachers.settings.profile', compact('teacher'));
    }}
