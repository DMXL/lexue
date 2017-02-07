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
 * Filename->replays.blade.php
 * Project->lexue
 * Description->This is the view for lectures.
 *
 * Created by DM on 17/2/7 下午1:26.
 * Copyright 2017 Team Sudo. All rights reserved.
 *
-->
@extends('wechat.layouts.blank')

@section('content')
    <div class="lectures_replays">
        <div class="weui_panel weui_panel_access">
            <div class="weui_panel_hd">直播课 - 回放</div>
            <div class="weui_panel_bd">

                @include('wechat.lectures.replayinfo')

            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection