<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TeacherOffTimeFormRequest;
use App\Models\Teacher\OffTime;
use App\Models\User\Teacher;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OffTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeacherOffTimeFormRequest|Request $request
     * @param $teacherId
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherOffTimeFormRequest $request, $teacherId)
    {
        try {
            $offTime = new OffTime();
            $offTime->teacher_id = $teacherId;
            $offTime->fill($request->all())->save();
        } catch (\Exception $e) {
            $this->handleException($e);
            return back();
        }

        \Flash::success('添加成功');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeacherOffTimeFormRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherOffTimeFormRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $teacherId
     * @param  int $offTimeId
     * @return \Illuminate\Http\Response
     */
    public function destroy($teacherId, $offTimeId)
    {
        try {
            OffTime::destroy($offTimeId);
        } catch (\Exception $e) {
            $this->handleException($e);
            return back();
        }

        \Flash::success('解除成功');
        return back();
    }
}
