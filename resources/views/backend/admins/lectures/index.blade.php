@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>所有课程</h5>
                </div>
                <div class="ibox-content">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>状态</th>
                            <th>日期</th>
                            <th>模式</th>
                            <th>学生</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lectures as $lecture)
                            <tr>
                                <td>
                                    @if($lecture->complete)
                                        <span class="label label-default">
                                            <s>完结</s>
                                        </span>
                                    @else
                                        <span class="label label-primary">待学</span>
                                    @endif
                                </td>
                                <td>{{ $lecture->human_time }}</td>
                                <td>
                                    @if( $lecture->single)
                                        <span class="label label-primary">一对一</span>
                                    @else
                                        <span class="label label-info">一对多</span>
                                    @endif
                                </td>
                                <td>{{ $lecture->student ? $lecture->student->name : '群P' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection