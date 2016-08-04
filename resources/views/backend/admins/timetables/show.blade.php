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
            <h4 class="no-margins vertical-middle inline">
                {{ $teacher->name }}
            </h4>
            <a href="{{ route('admins::teachers.show', $teacher->id) }}" class="btn btn-default btn-sm"><i class="fa fa-user"></i> 教师信息</a>
            <a href="{{ route('admins::teachers.timeslots.index', $teacher->id) }}" class="btn btn-default btn-sm"><i class="fa fa-wrench"></i> 修改课时</a>
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
                                                    <?php
                                                        if ($time['lecture']) {
                                                            $buttonClass = 'text-success';
                                                        } elseif ($time['offtime']) {
                                                            $buttonClass = 'text-danger';
                                                        } elseif (! $disabled) {
                                                            $buttonClass = 'btn-link';
                                                        } else {
                                                            $buttonClass = '';
                                                        }
                                                    ?>
                                                    <button type="button" class="btn {{ $buttonClass }} btn-sm"
                                                            data-toggle="modal"
                                                            data-target="{{ $time['lecture'] ? '#teacher-timetable-large' : '#teacher-timetable-small' }}"
                                                            data-snippet-url="{{ route('admins::teachers.timetable.snippet', ['teacher_id' => $teacher->id, 'date' => $time['date'], 'time_slot_id' => $time['time_slot_id']]) }}"
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

    <div class="modal inmodal fade teacher-timetable-modal" id="teacher-timetable-small" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-sm">
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

    <div class="modal inmodal fade teacher-timetable-modal" id="teacher-timetable-large" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4></h4>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function(){
            var teacherTimetableTemplate = '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> <span class="sr-only">Loading...</span></div>';

            var teacherTimetableModal = $('.teacher-timetable-modal');

            // init
            teacherTimetableModal.find('.modal-body').html(teacherTimetableTemplate);

            // show
            teacherTimetableModal.on('show.bs.modal', function (event) {
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

            // reset
            teacherTimetableModal.on('hide.bs.modal', function (event) {
                $(this).find('.modal-body').html(teacherTimetableTemplate);
            });
        });
    </script>
@endsection