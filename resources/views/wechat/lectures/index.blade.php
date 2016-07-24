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
 * Filename->index.blade.php
 * Project->lexue
 * Description->This is the view for lectures.
 *
 * Created by DM on 16/7/21 下午9:36.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
-->
@extends('wechat.layouts.blank')

@section('content')

    <div class="weui_panel weui_panel_access">
        <div class="weui_panel_hd">所有课程</div>
        <div class="weui_panel_bd">

            @foreach($lectures as $lecture)

                <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg">
                    <div class="weui_media_hd">
                        <img class="weui_media_appmsg_thumb" src="{{ getAvatarUrl($lecture->teacher->avatar, 'md') }}" alt="">
                    </div>
                    <div class="weui_media_bd">
                        <h4 class="weui_media_title">{{ $lecture->human_time }}</h4>
                        <p class="weui_media_desc">由各种物质组成的巨型球状天体，叫做星球。星球有一定的形状，有自己的运行轨道。</p>
                    </div>
                </a>

            @endforeach

        </div>
    </div>

@endsection

@section('js')

    @include('wechat.snippets.alert')

    <script>
        $('.weui_media_box').click(function() {
            $.actions({
                actions: [{
                    text: "更改课时",
                    className: "color-primary",
                    onClick: function() {
                        $.confirm("您确认要更改该课时信息吗？", "确认更改？", function() {
                            // 点击确认后的回调函数
                        }, function() {
                            // 点击取消后的回调函数
                        });
                    }
                },{
                    text: "删除课时",
                    className: "color-danger",
                    onClick: function() {
                        $.confirm("您确认要删除该课时吗？", "确认删除？", function() {
                            // 点击确认后的回调函数
                        }, function() {
                            // 点击取消后的回调函数
                        });
                    }
                }]
            });
        });
    </script>

@endsection