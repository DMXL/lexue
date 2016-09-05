<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\HandleLecturesCreated;
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
        $lectures = Lecture::orderByLatest()->with(['teacher' => function ($query) {
            $query->withTrashed();
        }])->paginate();

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
            $lectureId = \DB::transaction(function() use ($request) {
                $lecture = new Lecture();
                return $this->writeLectureData($lecture, $request);
            });
        } catch (\Exception $e) {
            $this->handleException($e);
            return back();
        }

        $this->dispatch(new HandleLecturesCreated($lectureId));
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
        $lecture = Lecture::find($id);

        return $this->backView('backend.admins.lectures.show', compact('lecture'));
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
     * @return int $id
     */
    private function writeLectureData(Lecture $lecture, LectureFormRequest $request)
    {
        $lecture->fill($request->all())->save();

        return $lecture;
    }
}
