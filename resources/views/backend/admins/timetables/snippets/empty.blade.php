<form action="{{ route('admins::teachers.offtimes.store', $teacher->id) }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="date" value="{{ $date }}">
    <input type="hidden" name="time_slot_id" value="{{ $timeSlotId }}">
    <button class="btn btn-danger btn-outline btn-block" type="submit">
        标记为不可约
    </button>
</form>