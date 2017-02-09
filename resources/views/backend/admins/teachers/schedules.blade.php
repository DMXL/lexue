@extends('backend.layouts.app')

@section('content')
    <div class="ibox">
        <div class="ibox-title">
            <h5>本周课表</h5>
        </div>
        <div class="ibox-content">
            <table class="table table-hover no-margins">
                @foreach($dailySchedules as $date => $schedules)
                    <thead>
                    <tr>
                        <th colspan="6">{{ humanDate($date, true) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($schedules as $schedule)
                        <tr>
                            @if($schedule->course_type == 'tutorial')
                                <td><a href="{{ route('admins::tutorials.index') }}"><span class="label label-weixin">微课</span></td>
                            @else
                                <td><a href="{{ route('admins::lectures.index') }}"><span class="label label-lexue">直播课</span></td>
                            @endif
                            <td><i class="fa fa-clock-o"></i>{{ humanTime($schedule->start).' - '.humanTime($schedule->end) }}</td>
                            <td>{{ $schedule->course_type == 'tutorial' ? $schedule->student->name : '' }}</td>
                            <td>{{ $schedule->course->name }}</td>
                            <td><a href="{{ route('admins::'.$schedule->course_type.'s.show', $schedule->course_id) }}">详情</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection