@extends('backend.layouts.app')

@section('content')
    <div class="ibox">
        <div class="ibox-content">
            <a href="{{ route('admins::lectures.create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> 添加直播课
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
                            <th>直播课名称</th>
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
                                    <img src="{{ $lecture->thumb->url('small') }}" alt="{{ $lecture->name }}" class="lecture-admin-thumb">
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
                                    {{ $lecture->start_time->format('Y年n月j日 H:i') }}
                                </td>
                                <td class="project-status">
                                    @if($lecture->finished)
                                        <span class="label label-default">已结束</span>
                                    @else
                                        @if(isset($lecture->room_id))
                                            <span class="label label-success">教室已开通</span>
                                        @else
                                            <span class="label label-danger">教室未开通</span>
                                        @endif
                                    @endif

                                    @if($lecture->enabled)
                                        <span class="label label-primary">已上线</span>
                                    @else
                                        <span class="label label-warning">未上线</span>
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
                    @if($lectures->render())
                        {{ $lectures->render() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection