@extends('backend.layouts.app')

@section('content')
    <div class="ibox">
        <div class="ibox-title">
            <a href="{{ route('admins::teachers.show', $teacher->id) }}" class="btn btn-default btn-sm">教师信息</a>
            <a href="{{ route('admins::teachers.timetables.index', $teacher->id) }}" class="btn btn-default btn-sm">查看课表</a>
        </div>
        <form action="{{ route('admins::teachers.timeslots.store', $teacher->id) }}" method="post">
            {{ csrf_field() }}
        <div class="ibox-content">
            <div class="row">
                <table class="table table-bordered text-center m-b-sm" id="teacher-timeslots">
                    <thead>
                    <tr>
                        <?php $dayParts = $timeslots->keys() ?>
                        @foreach($dayParts as $dayPart)
                            <th class="text-center">
                                {{ $dayPart }}
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($timeslots->first() as $index => $timeslotGroup)
                        <tr>
                            @foreach($dayParts as $dayPart)
                                <?php
                                    $timeslot = $timeslots[$dayPart][$index];
                                    $assigned = ($timeslot AND $teacherTimeslots->contains($timeslot->id));
                                ?>
                                <td class="{{ $assigned ? 'success' : '' }}">
                                    @if($timeslot)
                                        <div class="checkbox checkbox-success no-margins checked">
                                            <input type="checkbox" name="timeslots[]"
                                                   id="timeslot-{{ $timeslot->id }}"
                                                   value="{{ $timeslot->id }}"
                                                   @if($assigned)
                                                       checked="checked"
                                                   @endif
                                            >
                                            <label for="timeslot-{{ $timeslot->id }}">
                                                {{ $timeslots[$dayPart][$index]->range }}
                                            </label>
                                        </div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="ibox-footer text-center">
            <button type="submit" class="btn btn-primary">提交更新</button>
        </div>
        </form>
    </div>
@endsection

@section('js')

@endsection