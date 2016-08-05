<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course\Tutorial;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TutorialController extends Controller
{
    public function index()
    {
        $tutorials = Tutorial::orderByLatest()->with(['teacher', 'student'])->paginate();

        return $this->backView('admins.tutorials.index', compact('tutorials'));
    }
}
