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
    <div class="weui_panel weui_panel_access orders_index">
        <div class="weui_panel_hd">已购买公开课</div>
        <div class="weui_panel_bd">
            @foreach($orders as $order)
                <a href="http://weixin.duobeiyun.com/room/{{ $order->lecture->room_id }}" class="weui_media_box weui_media_appmsg weui_panel_ft">
                    <div class="weui_media_hd">
                        <img class="weui_media_appmsg_thumb" src="{{ $order->lecture->avatar->url('thumb') }}" alt="{{ $order->lecture->name }}">
                    </div>
                    <div class="weui_media_bd">
                        <h4 class="weui_media_title">{{ $order->lecture->name }}</h4>
                        <p class="weui_media_desc">
                            开播时间：{{ Carbon::parse($order->lecture->date_time) }}<br />
                            {{ $order->lecture->description }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection