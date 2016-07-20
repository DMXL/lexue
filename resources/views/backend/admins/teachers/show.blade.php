@extends('backend.layouts.app')

@section('content')
    <div class="ibox">
        <div class="ibox-content">
            <a href="{{ route('admins::teachers.index') }}" class="btn btn-default">
                <i class="fa fa-long-arrow-left"></i> 教师列表
            </a>
        </div>
    </div>

    <div class="ibox">
        <div class="ibox-title">
            <h5 class="no-margins vertical-middle">教师信息</h5>
            <div class="ibox-tools">
                <a href="{{ route('admins::teachers.edit', $teacher->id) }}" class="btn btn-warning btn-outline btn-xs">
                    <i class="fa fa-wrench"></i> 修改
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row m-b-lg m-t-lg">
                <div class="col-md-6">
                    <div class="profile-image">
                        <img src="{{ getAvatarUrl($teacher->avatar, 'md') }}" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info">
                        <div class="m-b-sm">
                            <h3 class="no-margins">
                                {{ $teacher->name }}
                            </h3>
                        </div>
                        <p>
                            {{ $teacher->description }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <table class="table m-b-xs vertical-middle">
                        <tbody>
                        <tr>
                            <td>
                                <strong>教师教龄</strong>
                            </td>
                            <td>
                                <span>
                                    {{ $teacher->years_of_teaching }}
                                </span>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <strong>课时费用</strong>
                            </td>
                            <td>
                                <span>
                                    {{ $teacher->price }}
                                </span>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <strong>授课范围</strong>
                            </td>
                            <td>
                                <span>
                                    @each('backend.admins.partials.tag', $teacher->levels->pluck('name'), 'name')
                                </span>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <strong>教师标签</strong>
                            </td>
                            <td>
                                @each('backend.admins.partials.tag', $teacher->labels->pluck('name'), 'name')
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection