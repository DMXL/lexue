@extends('frontend.layouts.app')

@section('content')
    <div class="ibox">
        <div class="ibox-title">
            <h5>公开课</h5>
        </div>
        <div class="ibox-content">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>公开课名称</th>
                    <th>报名人数</th>
                    <th>教师</th>
                    <th>时间</th>
                    <th>状态</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($lectures as $lecture)
                    <tr>
                        <td>
                            <img class="full-width" src="{{ $lecture->avatar->url('thumb') }}" alt="{{ $lecture->name }}">
                        </td>
                        <td class="text-left">
                            {{ $lecture->name }}
                        </td>
                        <td>
                            {{ $lecture->students()->count() }}
                        </td>
                        <td class="text-left">
                            <a href="{{ route('students::teachers.show', $lecture->teacher_id) }}">{{ $lecture->teacher->name }}</a>
                        </td>
                        <td>
                            {{ $lecture->human_date_time }}
                        </td>
                        <td class="project-status">
                            @if($lecture->finished)
                                <span class="label label-default">完结</span>
                            @else
                                <span class="label label-primary">待学</span>
                            @endif
                        </td>
                        <td class="project-actions">
                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> 详情 </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection