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
 * Filename->about.blade.php
 * Project->lexue
 * Description->The intro page for wechat lectures.
 *
 * Created by DM on 16/8/4 上午6:55.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
-->
@extends('wechat.layouts.blank')

@section('content')
    <div class="bd about">
        <div class="weui_panel weui_panel_access">
            <div class="weui_panel_hd">课程体验</div>
            <div class="weui_panel_bd">
                <br />
                <div class="weui_media_box weui_media_text">
                    <h4 class="weui_media_title">第一步 添加乐学云微信服务号</h4>
                    <p class="weui_media_desc">扫描二维码添加乐学云服务号，体验优质线上课程。</p><br />
                    <h4 class="weui_media_title">第二步 找名师约课程</h4>
                    <p class="weui_media_desc">点击进入服务号找老师功能，查看名师详细信息，选择心仪的教师和合适的上课时段点击购买课时。</p><br />
                    <h4 class="weui_media_title">第三步 添加客服教师微信群</h4>
                    <p class="weui_media_desc">购课成功后添加客服微信，客服将帮助您和教师建群，并在课前就您的学习需求进行充分的沟通，根据您的具体情况为您量身定制课程。</p><br />
                    <h4 class="weui_media_title">第四步 体验名师定制课程</h4>
                    <p class="weui_media_desc">教师会根据您的需求，在课前为您量身定制课程内容，并最晚于开课前2小时，讲课程讲义发送给您以供课前预习使用。</p><br />
                    <h4 class="weui_media_title">第五步 授课效果追踪服务</h4>
                    <p class="weui_media_desc">课程结束后24小时之内，您将收到我们客服对您听课效果的回访，已追踪您的学习效果，以便为您提供更优质的服务。</p><br />
                </div>
            </div>
        </div>
    </div>
@endsection
