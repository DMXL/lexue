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
 * Filename->records.blade.php
 * Project->lexue
 * Description->View for lectures replays.
 *
 * Created by DM on 16/10/9 上午10:38.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
-->
@extends('wechat.layouts.blank')

@section('content')
    <div class="weui_panel weui_panel_access lectures_index">
        <div class="weui_panel_hd">精彩回放</div>
        <div class="weui_panel_bd">

            @include('wechat.lectures.lectureinfo', ['lectures' => $records, 'status' => 'upcoming'])

        </div>
    </div>
@endsection