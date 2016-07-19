<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TimeSlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timeslots = TimeSlot::orderByStart()->get()->groupBy('day_part');

        $timeslots = padArray($timeslots);

        return $this->backView('admins.timeslots.index', compact('timeslots', 'rowCount'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'start' => 'required|regex:/^\d{2}:\d{2}$/',
            'length' => 'required|numeric'
        ], [
            'start.required' => '请填写开始时间',
            'start.regex' => '请确保开始时间格式为hh:mm',
            'length.required' => '请选择时长',
            'length.numeric' => '时长必须为数字',
        ]);

        $start = $request->input('start');
        $length = $request->input('length');

        /* calculate end time */
        $end = Carbon::parse($start)->addMinutes($length)->format('H:i');

        if (TimeSlot::where('start', $start)->where('end', $end)->exists()) {
            \Flash::error('重复课时');
            return back();
        }

        try {
            $timeSlot = new TimeSlot();
            $timeSlot->start = $start;
            $timeSlot->end = $end;
            $timeSlot->save();
        } catch (\Exception $e) {
            \Flash::error('系统错误');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
