<div class="text-center">
    <h4>
        今天有四儿！
    </h4>
</div>
<form action="{{ route('admins::teachers.offtimes.destroy', ['teacher_id' => $teacher->id, 'off_time_id' => $offTime->id]) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('delete') }}
    <input type="hidden" name="off_time_id" value="{{ $offTime->id }}">
    <button class="btn btn-primary btn-outline btn-block" type="submit">
        标记为可约
    </button>
</form>