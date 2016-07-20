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
        <div class="col-lg-3">
            <div class="contact-box center-version{{ $teacher->enabled ? '' : ' disabled' }}">

                <a href="{{ route('admins::teachers.show', $teacher->id) }}">

                    <img alt="image" class="img-circle" src="{{ getAvatarUrl($teacher->avatar, 'sm') }}">

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
                    <div class="m-t-md">
                        <p>
                            {{ str_limit($teacher->description, 40) }}
                        </p>
                    </div>

                </a>
                <div class="contact-box-footer">
                        <a href="{{ route('admins::teachers.show', $teacher->id) }}" class="btn btn-sm btn-white"><i class="fa fa-user"></i> 资料</a>
                        <a class="btn btn-sm btn-white"><i class="fa fa-calendar"></i> 课时</a>
                        <a class="btn btn-sm btn-white"><i class="fa fa-bullhorn"></i> 课程</a>
                </div>

            </div>
        </div>
        @endforeach
    </div>

    @if($teachers->render())
        {!! $teachers->render() !!}
    @endif
@endsection