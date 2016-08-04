<div class="row">
    <div class="col-lg-12">
        <div class="text-center">
            <h3>微课</h3>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>教师</th>
                <th>学生</th>
                <th>时间</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $tutorial->teacher->name }}</td>
                <td>
                    @if ($student = $tutorial->student)
                        {{ $student->name }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ $tutorial->human_date_time }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <a href="" class="btn btn-default btn-block" disabled>修改课程</a>
    </div>
</div>