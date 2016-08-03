<div class="ibox float-e-margins" id="teacher-form">
    <div class="ibox-title">
        <h5>添加教师</h5>
    </div>
    <div class="ibox-content">
        <form method="post" class="form-horizontal" action="{{ $action }}">
            {{ method_field($method) }}
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group{!! ($errors->has('name')) ? ' has-error' : '' !!}">
                        <label class="col-md-4 col-xs-2 control-label" for="teacher-name">教师姓名</label>
                        <div class="col-md-8 col-xs-10">
                            <input name="name" id="teacher-name" type="text" class="form-control" value="{!! Request::old('name', $defaults['name']) !!}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group{!! ($errors->has('email')) ? ' has-error' : '' !!}">
                        <label class="col-md-4 col-xs-2 control-label" for="teacher-email">教师邮箱</label>
                        <div class="col-md-8 col-xs-10">
                            <input name="email" id="teacher-email" type="text" class="form-control" value="{!! Request::old('email', $defaults['email']) !!}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group{!! ($errors->has('unit_price')) ? ' has-error' : '' !!}">
                <div class="col-md-6">
                    <div class="form-group{!! ($errors->has('unit_price')) ? ' has-error' : '' !!}">
                        <label class="col-md-4 col-xs-2 control-label" for="teacher-price">课时费用</label>
                        <div class="col-md-8 col-xs-10">
                            <div class="input-group">
                                <span class="input-group-addon">￥</span>
                                <input name="unit_price" id="teacher-price" type="text" class="form-control" value="{!! Request::old('unit_price', $defaults['unit_price']) !!}">
                            </div>
                        </div>
                    </div>
                </div>
                <label class="col-xs-2 control-label" for="teacher-years">教师教龄</label>
                <div class="col-xs-2">
                    <p class="form-control-static text-muted">@{{ yearsOfTeaching }}</p>
                </div>
                <div class="col-xs-2">
                    <div class="input-group">
                        <span class="input-group-addon"><small>起始年份</small></span>
                        <input type="text" id="teacher-years" name="teaching_since" class="form-control" value="{!! Request::old('teaching_since', $defaults['teaching_since']) !!}" v-model="teachingSince">
                    </div>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label for="teacher-levels" class="col-sm-2 control-label">教授范围</label>
                <div class="col-sm-10">
                    @foreach($levels as $level)
                        <div class="checkbox checkbox-success text-left col-md-2 col-sm-3 col-xs-6">
                            <input name="levels[]" id="teacher-level-{{ $level->id }}" value="{{ $level->id }}" type="checkbox" {{ in_array($level->id, Request::old('levels', $defaults['levels'])) ? 'checked' : '' }}>
                            <label for="teacher-level-{{ $level->id }}">
                                {{ $level->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label for="teacher-labels" class="col-sm-2 control-label">教师标签</label>
                <div class="col-sm-10">
                    <select name="labels[]" id="teacher-labels" class="form-control" multiple>
                        @foreach ($labels as $label)
                            <option value="{{ $label->name }}" {{ in_array($label->name, Request::old('labels', $defaults['labels'])) ? 'selected' : null }}>{{ $label->name }}</option>
                        @endforeach
                        @foreach(collect(Request::old('labels'))->diff($labels->pluck('name')->all())->all() as $label)
                                <option value="{{ $label }}" selected>{{ $label }}</option>
                        @endforeach
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

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <div class="col-lg-12 text-center">
                    <a class="btn btn-danger" href="{{ route('admins::teachers.index') }}">取消</a>
                    <button class="btn btn-primary" type="submit">提交</button>
                </div>
            </div>

        </form>
    </div>
</div>