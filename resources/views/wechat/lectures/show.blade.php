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
 * Filename->show.blade.php
 * Project->lexue
 * Description->view to show a lecture info
 *
 * Created by DM on 16/9/7 上午9:30.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
-->
@extends('wechat.layouts.blank')

@section('content')
    <div class="bd lectures_show" style="height: 100%;">
        <div class="weui_icon_area">
            <img src="{{ $lecture->avatar->url('medium') }}" />
        </div>
        <div class="weui_panel weui_panel_access">
            <div class="weui_panel_hd">
                <table class="lecture_info">
                    <tbody>
                        <tr>
                            <td>
                                课程名称：{{ $lecture->name }}<br />
                                开播时间：{{ Carbon::parse($lecture->date)->format('Y年n月j日') }} {{ $lecture->start }}<br />
                                {{ $lecture->orders()->count() }}人已报名
                            </td>
                            <td style="text-align: right;">
                                <span class="price">￥{{ number_format($lecture->price, 2) }}</span><br />
                                <span id="purchase" class="weui_btn weui_btn_mini weui_btn_primary">购买课时</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="weui_panel_bd">
                <a href="{{ route('m.students::teachers.show', $lecture->teacher->id) }}" class="weui_media_box weui_media_appmsg">
                    <div class="weui_media_hd">
                        <img class="weui_media_appmsg_thumb" src="{{ $lecture->teacher->avatar->url('thumb') }}" alt="{{ $lecture->teacher->name }}">
                    </div>
                    <div class="weui_media_bd">
                        <h4 class="weui_media_title">{{ $lecture->teacher->name }}</h4>
                        <p class="weui_media_desc">{{ $lecture->teacher->description }}</p>
                    </div>
                </a>
                <div class="weui_media_box weui_media_text">
                    <h4 class="weui_media_title">课程介绍</h4>
                    <p class="weui_media_desc lecture_desc">{{ $lecture->description }}</p>
                </div>
                <a href="javascript:void(0);" class="weui_panel_ft">学员评论</a>
            </div>
        </div>
    </div>

    <form id="lectures_form" action="{{ route('m.students::lectures.book', $lecture->id) }}" method="POST">
        {{ csrf_field() }}
    </form>
@endsection

@section('js')
    <script>
        // 点击'购买'按钮事件
        $('#purchase').click(function() {
            $.showLoading("进入支付页面...");
            $('#lectures_form').submit();
        });
    </script>
@endsection