<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course\Lecture;
use App\Models\User\Teacher;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\LectureFormRequest;
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
     * @param LectureFormRequest|Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(LectureFormRequest $request)
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
        return redirect()->route('admins::lectures.index');
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

        return $lecture;
    }
}
