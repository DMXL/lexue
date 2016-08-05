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
 * Description->This is the view for open lectures.
 *
 * Created by DM on 16/8/5 上午5:26.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
-->
@extends('wechat.layouts.blank')

@section('content')
    <div class="weui_tab lectures_index">
        <div class="weui_navbar">
            <a href="#tab1" class="weui_navbar_item weui_bar_item_on">
                即将开播
            </a>
            <a href="#tab2" class="weui_navbar_item">
                直播中
            </a>
        </div>
        <div class="weui_tab_bd">
            <div id="tab1" class="weui_tab_bd_item weui_tab_bd_item_active">
                <div class="weui_panel weui_panel_access">
                    <div class="weui_panel_bd">

                        @foreach($lectures as $lecture)
                            @if(Carbon::now()->diffInDays(Carbon::parse($lecture->date), false) >= 0)

                                <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg">
                                    <div class="weui_media_hd" data-value="{{ route('m.students::teachers.show', $lecture->teacher_id) }}">
                                        <div class="teacher_name">129人已报名</div>
                                        <img class="weui_media_appmsg_thumb" src="{{ $lecture->teacher->avatar->url('thumb') }}" alt="">
                                    </div>
                                    <div class="weui_media_bd">
                                        <h4 class="weui_media_title">{{ $lecture->name }}</h4>
                                        <p>{{ Carbon::parse($lecture->date)->format('Y年n月j日') }} {{ $lecture->human_time }}</p>
                                        <span class="badge success">￥{{ $lecture->teacher->unit_price }}.00</span>
                                    </div>
                                </a>

                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
            <div id="tab2" class="weui_tab_bd_item">
                <article class="weui_article">
                    <section>
                        <p>无正在直播的课程！</p>
                    </section>
                </article>
            </div>
        </div>
    </div>
@endsection