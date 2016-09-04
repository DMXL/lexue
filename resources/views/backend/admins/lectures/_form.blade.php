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
        <div class="form-group{!! ($errors->has('name')) ? ' has-error' : '' !!}">
            <label class="col-md-4 col-xs-2 control-label" for="lecture-name">课程名称</label>
            <div class="col-md-8 col-xs-10">
                <input name="name" id="lecture-name" type="text" class="form-control" value="{!! Request::old('name', $defaults['name']) !!}">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group{!! ($errors->has('teacher_id')) ? ' has-error' : '' !!}">
            <label class="col-md-4 col-xs-2 control-label" for="teacher-email">教师姓名</label>
            <div class="col-md-8 col-xs-10">
                <select name="teacher_id" id="lecture-teacher-id" class="form-control">
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group{!! ($errors->has('date')) ? ' has-error' : '' !!}">
            <label class="col-md-4 col-xs-2 control-label" for="lecture-date">课程日期</label>
            <div class="col-md-8 col-xs-10">
                <div class='input-group date' id='date-picker'>
                    <input name="date" id="lecture-date" type="text" class="form-control" value="{!! Request::old('date', $defaults['date']) !!}">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group{!! ($errors->has('start')) ? ' has-error' : '' !!}">
            <label class="col-md-4 col-xs-2 control-label" for="lecture-time">开始时间</label>
            <div class="col-md-8 col-xs-10">
                <div class='input-group date' id='time-picker'>
                    <input name="start" id="lecture-time" type="text" class="form-control" value="{!! Request::old('start', $defaults['start']) !!}">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group{!! ($errors->has('length')) ? ' has-error' : '' !!}">
            <label class="col-md-4 col-xs-2 control-label" for="lecture-length">课程时长</label>
            <div class="col-md-8 col-xs-10">
                <div class="input-group">
                    <select name="length" id="lecture-length" class="form-control">
                        <option value="30">30</option>
                        <option value="60">60</option>
                        <option value="90">90</option>
                        <option value="120">120</option>
                        <option value="120">150</option>
                        <option value="120">180</option>
                    </select>
                    <span class="input-group-addon">分钟</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group{!! ($errors->has('price')) ? ' has-error' : '' !!}">
            <label class="col-md-4 col-xs-2 control-label" for="teacher-price">课时费用</label>
            <div class="col-md-8 col-xs-10">
                <div class="input-group">
                    <span class="input-group-addon">￥</span>
                    <input name="price" id="lecture-price" type="text" class="form-control" value="{!! Request::old('price', $defaults['price']) !!}">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hr-line-dashed"></div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="lecture-description">课程简介</label>
    <div class="col-sm-10">
        <textarea name="description" id="lecture-description" class="form-control">{!! Request::old('description', $defaults['description']) !!}</textarea>
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