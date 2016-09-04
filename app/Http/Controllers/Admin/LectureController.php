<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course\Lecture;
use App\Models\User\Teacher;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lectures = Lecture::orderByLatest()->with('teacher')->paginate();

        return $this->backView('backend.admins.lectures.index', compact('lectures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::all();

        return $this->backView('backend.admins.lectures.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            \DB::transaction(function() use ($request) {
                $lecture = new Lecture();
                return $this->writeLectureData($lecture, $request);
            });
        } catch (\Exception $e) {
            $this->handleException($e);
            return back();
        }

        \Flash::success('添加成功');
        return redirect()->route('admins::lecture.index');
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

    /**
     * Write lecture form data to db.
     *
     * @param Lecture $lecture
     * @param LectureFormRequest $request
     * @return Lecture
     */
    private function writeLectureData(Lecture $lecture, LectureFormRequest $request)
    {
        $lecture->fill($request->all())->save();

        /* If have levels */
        if ($levels = $request->input('levels')) {
            $lecture->levels()->sync($levels);
        }

        /* If have labels */
        if ($labels = $request->input('labels')) {
            $existingLabels = Label::lists('name');

            /* If have new labels */
            $newLabels = collect($labels)->diff($existingLabels);
            foreach ($newLabels as $newLabel) {
                Label::create(['name' => $newLabel]);
            }

            $labelIds = Label::whereIn('name', $labels)->lists('id')->all();
            $lecture->labels()->sync($labelIds);
        }

        return $lecture;
    }
}
