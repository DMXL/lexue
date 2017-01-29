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
    <div class="bd teachers_index" style="height: 100%;">
        <div class="weui_panel weui_panel_access">
            <div class="weui_panel_hd">名师介绍</div>
            <div class="weui_panel_bd">

                @foreach($teachers as $teacher)

                    <a href="{{ route('m.students::teachers.show', $teacher->id) }}" class="weui_media_box weui_media_appmsg">
                        <div class="weui_media_hd">
                            <img class="weui_media_appmsg_thumb" src="{{ $teacher->avatar->url('thumb') }}" alt="{{ $teacher->name }}">
                        </div>
                        <div class="weui_media_bd">
                            <span class="pricetag">￥{{ number_format($teacher->unit_price, 2) }}/课时</span>
                            <h4 class="weui_media_title">{{ $teacher->name }}</h4>
                            <p class="weui_media_desc">{{ $teacher->years_of_teaching }}教龄&nbsp;&nbsp;授课年级: {{ $teacher->levels->implode('name', ',') }}</p>
                            <div class="badgegroup">
                                @foreach( $teacher->labels->pluck('name') as $name )
                                    <span class="badge secondary">{{ $name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </a>

                @endforeach

            </div>
        </div>
    </div>
@endsection