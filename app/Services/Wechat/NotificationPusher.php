<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 26/07/16
 * Time: 9:27 AM
 */

namespace App\Services\Wechat;


class NotificationPusher
{
    /**
     * @var \EasyWeChat\Foundation\Application
     */
    private $wechat;

    /**
     * NotificationPusher constructor.
     */
    public function __construct()
    {
        $this->wechat = app('wechat');
    }

    public function push($message)
    {
        \Log::info('sending message');

        $messageId = $this->wechat->notice->send($message);

        \Log::info('message sent with id: ' . $messageId);
    }
}