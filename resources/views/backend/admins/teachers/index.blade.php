@extends('backend.layouts.app')

@section('content')
    <div class="ibox">
        <div class="ibox-content">
            <a href="{{ route('admins::teachers.create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> 添加教师
            </a>
        </div>
    </div>

    <div class="row">
    @foreach($teachers as $teacher)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="contact-box center-version{{ $teacher->enabled ? '' : ' disabled' }}">

                <a href="{{ route('admins::teachers.show', $teacher->id) }}">

                    <img alt="image" class="img-circle" src="{{ $teacher->avatar->url('thumb') }}">

                    <h4 class="m-b-xs"><strong>{{ $teacher->name }}</strong></h4>
                    <br>
                    <div class="text-left">
                        <p>
                            <i class="fa fa-fw fa-certificate"></i>
                            @each('backend.admins.partials.tag', $teacher->levels->pluck('name'), 'name')
                        </p>
                        <p>
                            <i class="fa fa-fw fa-tags"></i>
                            @each('backend.admins.partials.tag', $teacher->labels->pluck('name'), 'name')
                        </p>
                    </div>
                </a>
                <div class="contact-box-footer">
                        <a href="{{ route('admins::teachers.timeslots.index', $teacher->id) }}" class="btn btn-sm btn-white">
                            <i class="fa fa-clock-o"></i> 课时</a>
                        <a href="{{ route('admins::teachers.timetables.index', $teacher->id) }}" class="btn btn-sm btn-white">
                            <i class="fa fa-calendar"></i> 课表</a>
                        <a class="btn btn-sm btn-white"><i class="fa fa-bullhorn"></i> 课程</a>
                </div>

            </div>
        </div>
    @endforeach
    </div>

    @if($teachers->render())
        <div class="row">
            <div class="col-lg-12 text-right">
                {!! $teachers->render() !!}
            </div>
        </div>
    @endif
@endsection