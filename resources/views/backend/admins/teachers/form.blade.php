<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>添加教师</h5>
    </div>
    <div class="ibox-content">
        <form method="post" class="form-horizontal" action="{{ route('admins::teachers.create') }}">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="teacher-name">教师姓名</label>
                <div class="col-sm-4">
                    <input name="name" id="teacher-name" type="text" class="form-control">
                </div>
                <label class="col-sm-2 control-label" for="teacher-price">课时费用</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-addon">￥</span>
                        <input name="unit_price" id="teacher-price" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="teacher-years">教师教龄</label>
                <div class="col-sm-2">
                    <p class="form-control-static text-muted">请直接输入起始年份</p>
                </div>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-addon"><small>起始年份</small></span>
                        <input type="text" id="teacher-years" name="teaching_since" class="form-control" placeholder="请输入完整年份, 例如2010">
                    </div>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label for="teacher-levels" class="col-sm-2 control-label">教授范围</label>
                <div class="col-sm-10">
                    <select id="teacher-levels" class="form-control" multiple="multiple">
                        <option value="AL">Alabama</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="teacher-labels" class="col-sm-2 control-label">教师标签</label>
                <div class="col-sm-10">
                    <select id="teacher-labels" class="form-control" multiple="multiple">
                        <option value="AL">Alabama</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="teacher-description">教师简介</label>
                <div class="col-sm-10">
                    <textarea name="description" id="teacher-description" class="form-control"></textarea>
                </div>
            </div>

        </form>
    </div>
</div>