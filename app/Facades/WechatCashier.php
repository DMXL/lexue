<?php
/**
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
 * Filename->WechatCashier.php
 * Project->lexue
 * Description->Facade for payment handler.
 *
 * Created by DM on 16/10/8 下午3:49.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
 */
namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class WechatCashier extends Facade
{
    protected static function getFacadeAccessor() { return 'wechat.cashier'; }
}