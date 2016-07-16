@extends('frontend.layouts.app')

@section('content')
    <div class="ibox">
        <div class="ibox-title">
            <h5>所有课程</h5>
        </div>
        <div class="ibox-content">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>状态</th>
                    <th>时间</th>
                    <th>类型</th>
                    <th>教师</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($lectures as $lecture)
                    <tr>
                        <td class="project-status">
                            @if($lecture->complete)
                                <span class="label label-default">完结</span>
                            @else
                                <span class="label label-primary">待学</span>
                            @endif
                        </td>
                        <td>
                            {{ $lecture->human_time }}
                        </td>
                        <td class="text-left">
                            @if($lecture->single)
                                <span class="badge badge-primary">一对一</span>
                            @else
                                <span class="badge badge-warning">一对多</span>
                            @endif
                        </td>
                        <td class="text-left">
                            <a href="{{ route('students::teachers.show', $lecture->teacher_id) }}">{{ $lecture->teacher->name }}</a>
                        </td>
                        <td class="project-actions">
                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection