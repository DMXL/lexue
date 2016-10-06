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
 * Filename->lectureinfo.blade.php
 * Project->lexue
 * Description->This is the snippet for displaying lecture info.
 *
 * Created by DM on 16/10/6 下午1:00.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
-->
@foreach($lectures as $lecture)
    <a href="http://weixin.duobeiyun.com/room/{{ $lecture->room_id }}" class="weui_media_box weui_media_appmsg weui_panel_ft">
        <div class="weui_media_hd">
            <img class="weui_media_appmsg_thumb" src="{{ $lecture->avatar->url('thumb') }}" alt="{{ $lecture->name }}">
        </div>
        <div class="weui_media_bd">
            <h4 class="weui_media_title">{{ $lecture->name }}</h4>
            <p class="weui_media_desc">
                开播时间：<span class="badge {{ $status == 'grey' ? 'dark' : 'success' }}">{{ $lecture->arrayed_time[0] }}</span><span class="badge {{ $status }}">{{ $lecture->arrayed_time[1] }}</span><br />
                {{ $lecture->description }}
            </p>
        </div>
    </a>
@endforeach