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
 * Filename->room.blade.php
 * Project->lexue
 * Description->view to show a lecture info
 *
 * Created by DM on 16/9/7 上午9:30.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
-->
@extends('wechat.layouts.blank')

@section('content')
    <iframe src="http://weixin.duobeiyun.com/room/{{ $roomId }}" style="border: medium none;display: block;height: 100%;width: 100%;" vspace="0" hspace="0" marginwidth="0" marginheight="0" scrolling="yes" frameborder="0" ></iframe>
@endsection

@section('js')
    <script>
        $(function() {
            $(window).resize(function() {
                $('iframe').css('height', $(window).height());
            });
            $('iframe').css('height', $(window).height());
        });
    </script>
@endsection