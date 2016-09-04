<!--
 *
 *
 *   ______                        _____           __
 *  /_  __/__  ____ _____ ___     / ___/__  ______/ /___
 *   / / / _ \/ __ `/ __ `__ \    \__ \/ / / / __  / __ \
 *  / / /  __/ /_/ / / / / / /   ___/ / /_/ / /_/ / /_/ /
 * /_/  \___/\__,_/_/ /_/ /_/   /____/\__,_/\__,_/\____/
 *
 *
 *
 * Filename->_form.blade.php
 * Project->lexue
 * Description->form to create lecture
 *
 * Created by DM on 16/9/4 上午11:48.
 * Copyright 2016 Team Sudo. All rights reserved.
-->
<div class="ibox float-e-margins" id="lecture-form">
    <div class="ibox-title">
        <h5>添加公开课</h5>
    </div>
    <div class="ibox-content">
        <form method="post" class="form-horizontal" action="{{ $action }}">
{{ method_field($method) }}
{{ csrf_field() }}
<div class="row">
    <div class="col-md-6">
        <div class="form-group{!! ($errors->has('lecture_name')) ? ' has-error' : '' !!}">
            <label class="col-md-4 col-xs-2 control-label" for="lecture-name">课程名称</label>
            <div class="col-md-8 col-xs-10">
                <input name="lecture_name" id="lecture-name" type="text" class="form-control" value="{!! Request::old('lecture_name', $defaults['lecture_name']) !!}">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group{!! ($errors->has('teacher_name')) ? ' has-error' : '' !!}">
            <label class="col-md-4 col-xs-2 control-label" for="teacher-email">教师姓名</label>
            <div class="col-md-8 col-xs-10">
                <input name="teacher_name" id="teacher-name" type="text" class="form-control" value="{!! Request::old('teacher_name', $defaults['teacher_name']) !!}">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group{!! ($errors->has('lecture_time')) ? ' has-error' : '' !!}">
            <label class="col-md-4 col-xs-2 control-label" for="lecture-time">课程时间</label>
            <div class="col-md-8 col-xs-10">
                <div class='input-group date' id='datetime-picker'>
                    <input name="lecture_time" id="lecture-time" type="text" class="form-control" value="{!! Request::old('lecture_time', $defaults['lecture_time']) !!}">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group{!! ($errors->has('lecture_length')) ? ' has-error' : '' !!}">
            <label class="col-md-4 col-xs-2 control-label" for="lecture-length">课程时长</label>
            <div class="col-md-8 col-xs-10">
                <div class="input-group">
                    <input name="lecture_length" id="lecture-length" type="text" class="form-control" value="{!! Request::old('lecture_length', $defaults['lecture_length']) !!}">
                    <span class="input-group-addon">分钟</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group{!! ($errors->has('lecture_price')) ? ' has-error' : '' !!}">
            <label class="col-md-4 col-xs-2 control-label" for="teacher-price">课时费用</label>
            <div class="col-md-8 col-xs-10">
                <div class="input-group">
                    <span class="input-group-addon">￥</span>
                    <input name="lecture_price" id="lecture-price" type="text" class="form-control" value="{!! Request::old('lecture_price', $defaults['lecture_price']) !!}">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hr-line-dashed"></div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="lecture-description">课程简介</label>
    <div class="col-sm-10">
        <textarea name="lecture_description" id="lecture-description" class="form-control"></textarea>
    </div>
</div>

<div class="hr-line-dashed"></div>

<div class="form-group">
    <div class="col-lg-12 text-center">
        <a class="btn btn-danger" href="{{ route('admins::lectures.index') }}">取消</a>
        <button class="btn btn-primary" type="submit">提交</button>
    </div>
</div>

</form>
</div>
</div>