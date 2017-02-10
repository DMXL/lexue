<?php

namespace App\Http\Controllers\Admin;

use App\Events\LectureCreated;
use App\Models\Course\Lecture;
use App\Models\User\Teacher;
use DB;
use Exception;
use Flash;
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
        return $this->backView('backend.admins.lectures.create');
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
        $lecture = $this->writeLectureData(new Lecture(), $request);

        event(new LectureCreated($lecture));
        Flash::success('添加成功');

        return redirect()->route('admins::lectures.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Lecture $lecture
     * @return \Illuminate\Http\Response
     */
    public function show(Lecture $lecture)
    {
        return $this->backView('backend.admins.lectures.show', compact('lecture'));
    }

    /**
     * Display lectures that belong to a certain teacher.
     *
     * @param Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function showTeacher(Teacher $teacher)
    {
        $lectures = $teacher->lectures;

        return $this->backView('backend.admins.teachers.lectures', compact('lectures', 'teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Lecture $lecture
     * @return \Illuminate\Http\Response
     */
    public function edit(Lecture $lecture)
    {
        return $this->backView('backend.admins.lectures.edit', compact('lecture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LectureFormRequest $request
     * @param Lecture $lecture
     * @return \Illuminate\Http\Response
     */
    public function update(LectureFormRequest $request, Lecture $lecture)
    {
        $lecture =  $this->writeLectureData($lecture, $request);

        Flash::success('信息已更新');

        return redirect()->route('admins::lectures.show', $lecture->id);
    }

    /**
     * Upload lecture thumbnail.
     *
     * @param Request $request
     * @param Lecture $lecture
     * @return int
     */
    public function uploadThumb(Request $request, Lecture $lecture)
    {
        $lecture->thumb = $request->file('thumb');
        $lecture->save();

        return 1;
    }

    /**
     * Put lecture online.
     *
     * @param Lecture $lecture
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enable(Lecture $lecture)
    {
        if (!$lecture->enabled) {
            $lecture->enabled = true;
            $lecture->save();
        }

        Flash::success('直播课已上线');
        return back();
    }

    /**
     * Pub lecture offline.
     *
     * @param Lecture $lecture
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disable(Lecture $lecture)
    {
        if ($lecture->enabled) {
            $lecture->enabled = false;
            $lecture->save();
        }

        Flash::success('直播课已下线');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Lecture $lecture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lecture $lecture)
    {
        $lecture->delete();

        Flash::success('删除成功');
        return redirect()->route('admins::lectures.index');
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
