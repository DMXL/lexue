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
 * Filename->replays.blade.php
 * Project->lexue
 * Description->This is the view for lectures.
 *
 * Created by DM on 17/2/7 下午1:26.
 * Copyright 2017 Team Sudo. All rights reserved.
 *
-->
@extends('wechat.layouts.blank')

@section('content')
    <div class="lectures_replays">
        <div class="weui_panel weui_panel_access">
            <div class="weui_panel_hd">直播课 - 回放</div>
            <div class="weui_panel_bd">

                @include('wechat.lectures.replayinfo')

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.weui_media_hd').click(function() {
            location.href = $(this).attr('data-value');
        });
        $('.weui_media_bd').click(function() {
            var infoLink = $(this).attr('data-info');
            var roomLink = $(this).attr('data-room');

            $.actions({
                actions: [{
                    text: "查看课程详情",
                    className: "color-primary",
                    onClick: function() {
                        location.href = infoLink;
                    }
                },{
                    text: "观看回放",
                    className: "color-primary",
                    onClick: function() {
                        location.href = "http://weixin.duobeiyun.com/room/" + roomLink;
                    }
                }]
            });
        });
    </script>
@endsection