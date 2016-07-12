@extends('frontend.layouts.app')

@section('content')
    <div class="ibox">
        <div class="ibox-title">
            <h5>All projects assigned to this account</h5>
            <div class="ibox-tools">
                <a href="" class="btn btn-primary btn-xs">Create new project</a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row m-b-sm m-t-sm">
                <div class="col-md-1">
                    <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                </div>
                <div class="col-md-11">
                    <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                </div>
            </div>

            <div class="project-list">

                <table class="table table-hover">
                    <tbody>
                    @foreach($lectures as $lecture)
                    <tr>
                        <td class="project-status">
                            @if($lecture->complete)
                            <span class="label label-default">完结</span>
                            @elseif($lecture->start_at->isPast())
                            <span class="label label-danger">过期</span>
                            @else
                            <span class="label label-primary">待学</span>
                            @endif
                        </td>
                        <td>
                            {{ Date::parse($lecture->start_at)->format('Fj\\号, l, h:i A') }}
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
    </div>

@endsection