<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course\TimeSlot;
use App\Models\User\Teacher;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TeacherTimeSlotController extends Controller
{
    public function store(Request $request, $id)
    {
        $timeslotIds = $request->input('timeslots') ? : [];

        $teacher = Teacher::findOrFail($id);

        $teacher->timeslots()->sync($timeslotIds);

        \Flash::success('修改成功');
        return back();
    }
}
