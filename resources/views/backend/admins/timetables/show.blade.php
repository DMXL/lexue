@extends('backend.layouts.app')

@section('content')
    <div class="ibox">
        <div class="ibox-content">
            <h4 class="no-margins vertical-middle inline">
                {{ $teacher->name }}
            </h4>
            <a href="{{ route('admins::teachers.show', $teacher->id) }}" class="btn btn-default btn-sm m-l-md"><i class="fa fa-user"></i> 教师信息</a>
        </div>
    </div>

    <div class="ibox">
        <div class="ibox-title">
            <h4 class="no-margins vertical-middle inline">微课课时</h4>
        </div>
        <form action="{{ route('admins::teachers.timeslots.store', $teacher->id) }}" method="post">
            {{ csrf_field() }}
            <div class="ibox-content">
                <div class="row">
                    <table class="table table-bordered text-center m-b-sm" id="teacher-timeslots">
                        <thead>
                        <tr>
                            <?php $dayParts = $timeslots->keys() ?>
                            @foreach($dayParts as $dayPart)
                                <th class="text-center">
                                    {{ $dayPart }}
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($timeslots->first() as $index => $timeslotGroup)
                            <tr>
                                @foreach($dayParts as $dayPart)
                                    <?php
                                    $timeslot = $timeslots[$dayPart][$index];
                                    $assigned = ($timeslot AND $teacherTimeslots->contains($timeslot->id));
                                    ?>
                                    <td class="{{ $assigned ? 'success' : '' }}">
                                        @if($timeslot)
                                            <div class="checkbox checkbox-success no-margins checked">
                                                <input type="checkbox" name="timeslots[]"
                                                       id="timeslot-{{ $timeslot->id }}"
                                                       value="{{ $timeslot->id }}"
                                                       @if($assigned)
                                                       checked="checked"
                                                        @endif
                                                >
                                                <label for="timeslot-{{ $timeslot->id }}">
                                                    {{ $timeslots[$dayPart][$index]->range }}
                                                </label>
                                            </div>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="ibox-footer text-center">
                <button type="submit" class="btn btn-primary">提交更新</button>
            </div>
        </form>
    </div>

    <div class="ibox">
        <div class="ibox-title">
            <h4 class="no-margins vertical-middle inline">微课课表</h4>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <strong>说明： </strong>
                    <div class="m-b-sm inline" disabled><button class="btn text-warning btn-sm"><s>微课</s></button></div>
                    <div class="m-b-sm inline" disabled><button class="btn text-danger btn-sm"><s>教师有事</s></button></div>
                </div>
            </div>
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
                                                    if ($time['tutorial']) {
                                                        $buttonClass = 'text-success';
                                                    } elseif ($time['tutorial']) {
                                                        $buttonClass = 'text-warning';
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
                                                            data-target="{{ $time['offtime'] ? '#teacher-timetable-small' : '#teacher-timetable-large' }}"
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