<div class="row">
    <div class="col-lg-12">
        <div class="text-center">
            <h3>直播课</h3>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>教师</th>
                <th>报名人数</th>
                <th>名字</th>
                <th>时间</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $lecture->teacher->name }}</td>
                <td>
                    {{ $lecture->students()->count() }}
                </td>
                <td>{{ $lecture->name }}</td>
                <td>{{ $lecture->human_date_time }}</td>
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