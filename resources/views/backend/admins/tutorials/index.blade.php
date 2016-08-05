@extends('backend.layouts.app')

@section('content')
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
                            <th>学生</th>
                            <th>教师</th>
                            <th>时间</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tutorials as $tutorial)
                            <tr>
                                <td>
                                    {{ $tutorial->student->name }}
                                </td>
                                <td class="text-left">
                                    <a href="{{ route('students::teachers.show', $tutorial->teacher_id) }}">{{ $tutorial->teacher->name }}</a>
                                </td>
                                <td>
                                    {{ $tutorial->human_date_time }}
                                </td>
                                <td class="project-status">
                                    @if($tutorial->finished)
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
                <div class="ibox-footer text-right">
                    {{ $tutorials->render() }}
                </div>
            </div>
        </div>
    </div>
@endsection