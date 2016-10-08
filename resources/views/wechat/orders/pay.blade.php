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
 * Filename->pay.blade.php
 * Project->lexue
 * Description->View for payment.
 *
 * Created by DM on 16/10/8 下午3:26.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
-->
@extends('wechat.layouts.jssdk')

@section('content')

    <div class="weui_msg orders_pay">
        <div class="weui_text_area">
            <p class="weui_msg_desc">乐学-订单编号{{ $order->id }}</p>
            <h2 class="weui_msg_title">￥{{ number_format($order->total, 2) }}</h2>
        </div>
        <div class="weui_cells">
            <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>收款方</p>
                </div>
                <div class="weui_cell_ft">
                    乐学云lexuecloud.com
                </div>
            </div>
        </div>
        <div class="weui_opr_area">
            <p class="weui_btn_area">
                <span id="pay" class="weui_btn weui_btn_primary">立即支付</span>
            </p>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $('#pay').click(function() {
            console.log({!! json_encode($attributes) !!});
        });
    </script>
@endsection