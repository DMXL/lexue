@extends('backend.layouts.app')

@section('content')
    <div class="ibox">
        <div class="ibox-content">
            <a href="{{ route('admins::lectures.create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> 添加公开课
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>所有课程</h5>
                </div>
                <div class="ibox-content">

                    <table class="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>公开课名称</th>
                            <th>报名人数</th>
                            <th>教师</th>
                            <th>开始时间</th>
                            <th>状态</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lectures as $lecture)
                            <tr>
                                <td>
                                    <img src="{{ $lecture->avatar->url('thumb') }}" alt="{{ $lecture->name }}" class="lecture-admin-thumb">
                                </td>
                                <td class="text-left">
                                    {{ $lecture->name }}
                                </td>
                                <td>
                                    {{ $lecture->orders()->count() }}
                                </td>
                                <td class="text-left">
                                    <a href="{{ route('admins::teachers.show', $lecture->teacher_id) }}">{{ $lecture->teacher->name }}</a>
                                </td>
                                <td>
                                    {{ $lecture->date_time }}
                                </td>
                                <td class="project-status">
                                    @if($lecture->finished)
                                        <span class="label label-default">完结</span>
                                    @else
                                        <span class="label label-primary">待学</span>
                                    @endif
                                </td>
                                <td class="project-actions">
                                    <a href="{{ route('admins::lectures.show', $lecture->id) }}" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> 详情 </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="ibox-footer text-right">
                    {{ $lectures->render() }}
                </div>
            </div>
        </div>
    </div>
@endsection