<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>教师</th>
                <th>学生</th>
                <th>模式</th>
                <th>时间</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $lecture->teacher->name }}</td>
                <td>
                    @if ($student = $lecture->student)
                        {{ $student->name }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ $lecture->mode }}</td>
                <td>{{ $lecture->human_time }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <a href="" class="btn btn-default btn-block">修改课程</a>
    </div>
</div>