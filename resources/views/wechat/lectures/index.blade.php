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
 * Created by DM on 16/8/5 上午5:26.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
-->
@extends('wechat.layouts.blank')

@section('content')
    <div class="weui_tab lectures_index">

        <div class="weui_tab_bd">

            <div id="tab1" class="weui_tab_bd_item weui_tab_bd_item_active">
                <div class="weui_panel weui_panel_access">
                    <div class="weui_panel_hd">直播课 - 即将开播</div>
                    <div class="weui_panel_bd">

                        @include('wechat.lectures.lectureinfo', ['lectures' => $upcoming, 'status' => 'upcoming'])

                    </div>
                </div>
            </div>

            <div id="tab2" class="weui_tab_bd_item">
                <div class="weui_panel weui_panel_access">
                    <div class="weui_panel_hd">直播课 - 直播中</div>
                    <div class="weui_panel_bd">

                        @include('wechat.lectures.lectureinfo', ['lectures' => $ongoing, 'status' => 'ongoing'])

                    </div>
                </div>
            </div>

            <div id="tab3" class="weui_tab_bd_item">
                <div class="weui_panel weui_panel_access">
                    <div class="weui_panel_hd">直播课 - 我的直播课</div>
                    <div class="weui_panel_bd">

                        @include('wechat.lectures.lectureinfo', ['lectures' => $userLectures, 'status' => 'user'])

                    </div>
                </div>
            </div>

        </div>

        <div class="weui_tabbar">

            <a href="#tab1" class="weui_tabbar_item weui_bar_item_on">
                <div class="weui_tabbar_icon">
                    <i class="fa fa-calendar"></i>
                </div>
                <p class="weui_tabbar_label">即将开播</p>
            </a>

            <a href="#tab2" class="weui_tabbar_item">
                <div class="weui_tabbar_icon">
                    <i class="fa fa-video-camera"></i>
                </div>
                <p class="weui_tabbar_label">
                    直播中
                    @if($count > 0)
                        <span class="label lexue">{{ $count }}</span>
                    @endif
                </p>
            </a>

            <a href="#tab3" class="weui_tabbar_item">
                <div class="weui_tabbar_icon">
                    <i class="fa fa-user-circle-o"></i>
                </div>
                <p class="weui_tabbar_label">我的直播课</p>
            </a>

        </div>

    </div>
@endsection

@section('js')
    <script>
        routie({
            ':tab': function(tab) {
                $('a[href=#' + tab + ']').click();
            }
        });
        $('#tab3 .weui_panel_ft').click(function() {
            var panelBody = $(this).children('.weui_media_bd');
            var infoLink = panelBody.attr('data-info');
            var roomLink = panelBody.attr('data-room');
            var buttonText = panelBody.hasClass('finished') ? "观看回放" : "进入教室";

            $.actions({
                actions: [{
                    text: "查看课程详情",
                    className: "color-primary",
                    onClick: function() {
                        location.href = infoLink;
                    }
                },{
                    text: buttonText,
                    className: "color-primary",
                    onClick: function() {
                        location.href = "http://weixin.duobeiyun.com/room/" + roomLink;
                    }
                }]
            });
        });
    </script>
@endsection