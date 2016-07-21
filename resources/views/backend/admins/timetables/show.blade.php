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
            <h5 class="no-margins vertical-middle inline">
                <a href="{{ route('admins::teachers.show', $teacher->id) }}">{{ $teacher->name }}</a> - 教师课表
            </h5>
            <div class="ibox-tools ibox-tools-buttons">
                <a href="" class="btn btn-default btn-xs"><i class="fa fa-wrench"></i> 修改</a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                @foreach($timetable as $dayOfWeek => $day)
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center">
                                {{ $day['date'] }} {{ humanDayOfWeek($dayOfWeek) }}
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    @foreach(collect($day['times'])->groupBy('dayPart') as $dayPart => $times)
                                        <div class="col-sm-4 text-center m-n">
                                            <h4 class="border-bottom p-xs">{{ $dayPart }}</h4>
                                            @foreach($times as $time)
                                                <?php $disabled = $time['disabled'] ?>
                                                <div class="m-b-sm"{{ $disabled ? " disabled=disabled" : null }}>
                                                    <button type="button" class="btn btn-link btn-sm"
                                                            data-toggle="modal"
                                                            data-target="{{ $disabled ? '#teacher-timetable-taken' : '#teacher-timetable-empty' }}"
                                                            data-snippet-url="{{ route('admins::timetables.snippets.show', ['teacher_id' => $teacher->id, 'date' => $time['date'], 'time_slot_id' => $time['time_slot_id']]) }}"
                                                            data-title="{{ $time['string'] }}">
                                                        <small>
                                                            @if($disabled)
                                                                <s>{{ $time['range'] }}</s>
                                                            @else
                                                                {{ $time['range'] }}
                                                            @endif
                                                        </small>
                                                    </button>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal inmodal fade" id="teacher-timetable-empty" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4></h4>
                </div>
                <div class="modal-body">
                    <button class="btn btn-default btn-outline btn-block">
                        手动添加课程
                    </button>
                    <button class="btn btn-danger btn-outline btn-block">
                        标记为不可约
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal fade" id="teacher-timetable-taken" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4></h4>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#teacher-timetable-empty').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var title = button.data('title');
            var modal = $(this);
            modal.find('h4').text(title);
        })

        var teacherTimetableTakenButton = $('#teacher-timetable-taken');

        teacherTimetableTakenButton.on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var title = button.data('title');
            var snippetUrl = button.data('snippet-url');
            var modal = $(this);
            var modalBody = modal.find('.modal-body');
            modal.find('h4').text(title);
            $.ajax({
                url: snippetUrl
            }).done(function(data) {
                modalBody.html(data);
            });
        });

        teacherTimetableTakenButton.on('hide.bs.modal', function (event) {
            var loadingHtml = '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> <span class="sr-only">Loading...</span></div>';
            $(this).find('.modal-body').html(loadingHtml);
        });
    </script>
@endsection