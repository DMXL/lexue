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
 * Description->The order list.
 *
 * Created by DM on 16/9/7 下午1:22.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
-->
@extends('wechat.layouts.blank')

@section('content')
    <div class="weui_tab orders_index">

        <div class="weui_tab_bd">

            <div id="tab1" class="weui_tab_bd_item weui_tab_bd_item_active">
                <div class="weui_panel weui_panel_access">
                    <div class="weui_panel_hd">我的公开课 - 即将开始</div>
                    <div class="weui_panel_bd">

                        @include('wechat.orders.lectureinfo', ['lectures' => $upcoming, 'status' => 'primary'])

                    </div>
                </div>
            </div>

            <div id="tab2" class="weui_tab_bd_item">
                <div class="weui_panel weui_panel_access">
                    <div class="weui_panel_hd">我的公开课 - 正在直播</div>
                    <div class="weui_panel_bd">

                        @include('wechat.orders.lectureinfo', ['lectures' => $ongoing, 'status' => 'alert'])

                    </div>
                </div>
            </div>

            <div id="tab3" class="weui_tab_bd_item">
                <div class="weui_panel weui_panel_access">
                    <div class="weui_panel_hd">我的公开课 - 已结束</div>
                    <div class="weui_panel_bd">

                        @include('wechat.orders.recordinfo', ['lectures' => $finished])

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
                <p class="weui_tabbar_label">正在直播</p>
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