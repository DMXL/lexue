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
 * Filename->tutorialinfo.blade.php
 * Project->lexue
 * Description->This is the snippet for displaying tutorial info.
 *
 * Created by DM on 16/10/7 上午12:02.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
-->
@foreach($tutorials as $tutorial)
    <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg weui_panel_ft">
        <div class="weui_media_hd" data-value="{{ route('m.students::teachers.show', $tutorial->teacher_id) }}">
            <img class="weui_media_appmsg_thumb" src="{{ $tutorial->teacher->avatar->url('thumb') }}" alt="{{ $tutorial->teacher->name }}">
        </div>
        <div class="weui_media_bd">
            <h4 class="weui_media_title">{{ $tutorial->human_time }} {{ $tutorial->teacher->name }}老师</h4>
            <p class="weui_media_desc">
                <span class="badge {{ $status == 'grey' ? 'dark' : 'success' }}">{{ $tutorial->date }}</span> <span class="badge {{ $status }}">{{ $tutorial->timeSlot->range }}</span>
            </p>
        </div>
    </a>
@endforeach