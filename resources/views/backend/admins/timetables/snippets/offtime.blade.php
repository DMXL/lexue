<div class="text-center">
    <h4>
        @if($offTime->all_day)
            教师全天有事，无法上课
        @else
            教师该时段有事，无法上课
        @endif
    </h4>
</div>
<form action="{{ route('admins::teachers.offtimes.destroy', ['teacher_id' => $teacher->id, 'off_time_id' => $offTime->id]) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('delete') }}
    <input type="hidden" name="off_time_id" value="{{ $offTime->id }}">
    <input type="hidden" name="date" value="{{ $date }}">
    <input type="hidden" name="time_slot_id" value="{{ $timeSlotId }}">
    <button class="btn btn-primary btn-outline btn-block" type="submit">
        标记时段为可约
    </button>
</form>
@if($offTime->all_day)
<br>
<form action="{{ route('admins::teachers.offtimes.destroy', ['teacher_id' => $teacher->id, 'off_time_id' => $offTime->id]) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('delete') }}
    <input type="hidden" name="all_day" value="1">
    <input type="hidden" name="off_time_id" value="{{ $offTime->id }}">
    <button class="btn btn-default btn-outline btn-block" type="submit">
        标记全天为可约
    </button>
</form>
@endif