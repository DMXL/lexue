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
    <div class="weui_tab tutorials_index">

        <div class="weui_tab_bd">

            <div id="tab1" class="weui_tab_bd_item weui_tab_bd_item_active">
                <div class="weui_panel weui_panel_access">
                    <div class="weui_panel_hd">我的微课 - 即将开始</div>
                    <div class="weui_panel_bd">

                        @include('wechat.tutorials.tutorialinfo', ['tutorials' => $upcoming, 'status' => 'primary'])

                    </div>
                </div>
            </div>

            <div id="tab2" class="weui_tab_bd_item">
                <div class="weui_panel weui_panel_access">
                    <div class="weui_panel_hd">我的微课 - 正在进行</div>
                    <div class="weui_panel_bd">

                        @include('wechat.tutorials.tutorialinfo', ['tutorials' => $ongoing, 'status' => 'alert'])

                    </div>
                </div>
            </div>

            <div id="tab3" class="weui_tab_bd_item">
                <div class="weui_panel weui_panel_access">
                    <div class="weui_panel_hd">我的微课 - 已结束</div>
                    <div class="weui_panel_bd">

                        @include('wechat.tutorials.tutorialinfo', ['tutorials' => $finished, 'status' => 'grey'])

                    </div>
                </div>
            </div>

        </div>

        <div class="weui_tabbar">

            <a href="#tab1" class="weui_tabbar_item weui_bar_item_on">
                <div class="weui_tabbar_icon">
                    <i class="fa fa-calendar"></i>
                </div>
                <p class="weui_tabbar_label">即将开始</p>
            </a>

            <a href="#tab2" class="weui_tabbar_item">
                <div class="weui_tabbar_icon">
                    <i class="fa fa-video-camera"></i>
                </div>
                <p class="weui_tabbar_label">正在进行</p>
            </a>

            <a href="#tab3" class="weui_tabbar_item">
                <div class="weui_tabbar_icon">
                    <i class="fa fa-calendar-check-o"></i>
                </div>
                <p class="weui_tabbar_label">已结束</p>
            </a>

        </div>

    </div>



@endsection

@section('js')

    @include('wechat.snippets.alert')

    <script>
        $('.weui_media_hd').click(function() {
            location.href = $(this).attr('data-value');
        });
        $('.weui_media_bd').click(function() {
            $.actions({
                actions: [{
                    text: "更改课时",
                    className: "color-primary",
                    onClick: function() {
                        $.alert("请致电唯开乐学客服电话", "更改课时");
                    }
                },{
                    text: "删除课时",
                    className: "color-danger",
                    onClick: function() {
                        $.alert("请致电唯开乐学客服电话", "删除课时");
                    }
                }]
            });
        });
    </script>

@endsection