<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index()
    {
        return $this->frontendView('home');
    }

    public function profile()
    {
        return $this->frontendView('profile');
    }
}
