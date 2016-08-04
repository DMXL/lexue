<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherFormRequest;
use App\Models\Teacher\Label;
use App\Models\Teacher\Level;
use App\Models\User\Teacher;
use App\Services\Image\LocalImageHandler;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::paginate();

        return $this->backView('backend.admins.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->backView('backend.admins.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeacherFormRequest|Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(TeacherFormRequest $request)
    {
        try {
            $teacher = \DB::transaction(function() use ($request) {
                $teacher = new Teacher();
                return $this->writeTeacherData($teacher, $request);
            });
        } catch (\Exception $e) {
            $this->handleException($e);
            return back();
        }

        \Flash::success('添加成功');
        return redirect()->route('admins::teachers.show', $teacher->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = Teacher::find($id);

        return $this->backView('backend.admins.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = Teacher::find($id);

        return $this->backView('backend.admins.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeacherFormRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherFormRequest $request, $id)
    {
        try {
            $teacher = \DB::transaction(function() use ($request, $id) {
                $teacher = Teacher::find($id);
                return $this->writeTeacherData($teacher, $request);
            });
        } catch (\Exception $e) {
            $this->handleException($e);
            return back();
        }

        \Flash::success('添加成功');
        return redirect()->route('admins::teachers.show', $teacher->id);
    }

    public function uploadAvatar(Request $request, $id)
    {
        /** @var \App\Models\User\Teacher $teacher */
        $teacher = Teacher::findOrFail($id);

        $teacher->avatar = $request->file('avatar');
        $teacher->save();

        return 1;
    }

    public function enable($id)
    {
        try {
            $teacher = Teacher::find($id);
            if (!$teacher->enabled) {
                $teacher->enabled = true;
                $teacher->save();
            }
        } catch (\Exception $e) {
            // TODO logging and notify
            return back();
        }

        \Flash::success('教师已上线');
        return back();
    }

    public function disable($id)
    {
        try {
            $teacher = Teacher::find($id);
            if ($teacher->enabled) {
                $teacher->enabled = false;
                $teacher->save();
            }
        } catch (\Exception $e) {
            // TODO logging and notify
            return back();
        }

        \Flash::success('教师已下线');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Teacher::destroy($id);
        } catch (\Exception $e) {
            $this->handleException($e);
            return back();
        }

        \Flash::success('删除成功');
        return redirect()->route('admins::teachers.index');
    }

    /**
     * Write teacher form data to db.
     *
     * @param Teacher $teacher
     * @param TeacherFormRequest $request
     * @return Teacher
     */
    private function writeTeacherData(Teacher $teacher, TeacherFormRequest $request)
    {
        $teacher->fill($request->all())->save();

        /* If have levels */
        if ($levels = $request->input('levels')) {
            $teacher->levels()->sync($levels);
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
            $teacher->labels()->sync($labelIds);
        }

        return $teacher;
    }
}
