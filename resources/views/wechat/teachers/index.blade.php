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
 * Description->The teachers list.
 *
 * Created by DM on 16/7/14 下午2:43.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
-->
@extends('wechat.layouts.blank')

@section('content')
    <div class="weui_panel weui_panel_access lewe_panel">
        <div class="weui_panel_hd">名师介绍</div>
        <div class="weui_panel_bd">

            @foreach($teachers as $teacher)
                <a href="{{ route('wechat::teachers.show', $teacher->id) }}" data-transition="slidefade" class="weui_media_box weui_media_appmsg">
                    <div class="weui_media_hd">
                        <img class="weui_media_appmsg_thumb" src="{{ getAvatar($teacher->avatar, 'sm') }}" alt="{{ $teacher->name }}">
                    </div>
                    <div class="weui_media_bd">
                        <span class="teachers_pricetag">￥{{ $teacher->unit_price }}.00/时</span>
                        <h4 class="weui_media_title">{{ $teacher->name }}</h4>
                        <p class="weui_media_desc">{{ $teacher->years_of_teaching }}年教龄&nbsp;&nbsp;授课年级: {{ $teacher->levels->implode('name', ',') }}</p>
                        <div class="teachers_badgegroup">
                            <span class="badge primary">资格证</span><span class="badge secondary">学历</span>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
        <!--
        <a class="weui_panel_ft" href="javascript:void(0);">查看更多</a>
        -->
    </div>
@endsection