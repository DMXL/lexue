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
 * Filename->result.blade.php
 * Project->lexue
 * Description->View for payment result.
 *
 * Created by DM on 16/10/9 上午1:27.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
-->
@extends('wechat.layouts.blank')

@section('content')
    <div class="weui_msg order_payresult">
        <div class="weui_icon_area"><i class="weui_icon_success weui_icon_msg"></i></div>
        <div class="weui_text_area">
            <h2 class="weui_msg_title">支付成功</h2>
            <p class="weui_msg_desc">您已支付金额 {{ number_format($order->total, 2) }} 元</p>
        </div>
        <div class="weui_opr_area">
            <p class="weui_btn_area">
                <a href="{{ route('m.students::lectures.index') }}" class="weui_btn weui_btn_primary">查看详情</a>
            </p>
        </div>
        <!--
        <div class="weui_extra_area">
            <a href="">查看详情</a>
        </div>
        -->
    </div>
@endsection