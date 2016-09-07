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
 * Filename->lecturebrief.blade.php
 * Project->lexue
 * Description->breif info of a lecture
 *
 * Created by DM on 16/9/7 上午6:58.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
-->
<a href="{{ route('m.students::lectures.show', $lecture->id) }}" class="weui_media_box weui_media_appmsg">

    <div class="weui_media_hd" data-value="{{ route('m.students::teachers.show', $lecture->teacher_id) }}">

        <div class="teacher_name">{{ $lecture->orders()->count() }}人已报名</div>
        <img class="weui_media_appmsg_thumb" src="{{ $lecture->avatar->url('thumb') }}" alt="{{ $lecture->name }}">

    </div>

    <div class="weui_media_bd">

        <h4 class="weui_media_title">{{ $lecture->name }}</h4>
        <p>{{ Carbon::parse($lecture->date)->format('Y年n月j日') }} {{ $lecture->start }}</p>
        <span class="badge success">￥{{ number_format($lecture->price, 2) }}</span>

    </div>
</a>