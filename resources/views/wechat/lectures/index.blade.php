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
    <div class="weui_tab lectures_index">

        <div class="weui_tab_bd">

            <div id="tab1" class="weui_tab_bd_item weui_tab_bd_item_active">
                <div class="weui_panel weui_panel_access">
                    <div class="weui_panel_bd">

                        @foreach($lectures as $lecture)
                            @if(!$lecture->complete)

                                <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg">
                                    <div class="weui_media_hd">
                                        <div class="teacher_name">{{ $lecture->teacher->name }}</div>
                                        <img class="weui_media_appmsg_thumb" src="{{ getAvatarUrl($lecture->teacher->avatar, 'md') }}" alt="">
                                    </div>
                                    <div class="weui_media_bd">
                                        <h4 class="weui_media_title">{{ $lecture->human_time }}</h4>

                                        @if(Carbon::now()->diffInDays(Carbon::parse($lecture->date), false) < 0)
                                            <span class="badge grey">{{ $lecture->date }}</span>
                                        @else
                                            <span class="badge success">{{ $lecture->date }}</span>
                                        @endif

                                        @if($lecture->single)
                                            <span class="badge secondary">一对一</span>
                                        @else
                                            <span class="badge primary">一对多</span>
                                        @endif
                                    </div>
                                </a>

                            @endif
                        @endforeach

                    </div>
                </div>
            </div>

            <div id="tab2" class="weui_tab_bd_item">
                @foreach($lectures as $lecture)
                    @if($lecture->complete)

                        <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg">
                            <div class="weui_media_hd">
                                <img class="weui_media_appmsg_thumb" src="{{ getAvatarUrl($lecture->teacher->avatar, 'md') }}" alt="">
                            </div>
                            <div class="weui_media_bd">
                                <h4 class="weui_media_title">{{ $lecture->human_date_time }}</h4>
                                <p class="weui_media_desc">由各种物质组成的巨型球状天体，叫做星球。星球有一定的形状，有自己的运行轨道。</p>
                            </div>
                        </a>

                    @endif
                @endforeach
            </div>
        </div>

        <div class="weui_tabbar">

            <a href="#tab1" class="weui_tabbar_item weui_bar_item_on">
                <div class="weui_tabbar_icon">
                    <i class="fa fa-check-square-o"></i>
                </div>
                <p class="weui_tabbar_label">待学</p>
            </a>

            <a href="#tab2" class="weui_tabbar_item">
                <div class="weui_tabbar_icon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <p class="weui_tabbar_label">完结</p>
            </a>

        </div>

    </div>



@endsection

@section('js')

    @include('wechat.snippets.alert')

    <script>
        $('.weui_media_hd').click(function() {
            location.href = '{{ route('m.students::teachers.show', $lecture->teacher_id) }}';
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