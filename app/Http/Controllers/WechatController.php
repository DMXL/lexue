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
 * Filename->WechatController.php
 * Project->lewechat
 * Description->The controller for Wechat.
 *
 * Created by DM on 16/7/13 下午12:49.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
 */
namespace App\Http\Controllers;

use EasyWeChat\Message\Text;
use EasyWeChat\Support\Collection;
use Log;

class WechatController extends Controller
{


    /**
     * Overtrue wechat实例
     *
     * @var \EasyWeChat\Foundation\Application
     */
    private $wechat;

    /**
     * WechatController实例化
     */
    public function __construct()
    {
        // 获取wechat singleton
        $this->wechat = app('wechat');
    }

    /**
     * 处理微信服务器验证
     */
    public function verify()
    {
        return $this->wechat->server->serve();
    }

    /**
     * 处理微信的用户请求
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.');

        $wechatServer = $this->wechat->server;

        $wechatServer->setMessageHandler(function($message){
            // 注意，这里的 $message 不仅仅是用户发来的消息，也可能是事件
            // 当 $message->MsgType 为 event 时为事件
            if ($message->MsgType === 'event') {
                switch ($message->Event) {
                    case 'subscribe':
                        return new Text(['content' => $this->getSubText()]);
                        break;
                    default:
                        break;
                }
            }

            return '';
        });

        Log::info('return response.');

        return $wechatServer->serve();
    }

    /**
     * 获取订阅返回消息内容
     * TODO 后期考虑从API读取回复内容，并做本地缓存
     *
     * @return string
     */
    private function getSubText()
    {
        return "您好，欢迎关注乐学云官方服务号！乐学云—让老师变名师，让学生变学霸！\n\n".
        "乐学云是一款针对公立小学和初中英语科目，服务于老师和学生的教学，提分神器。\n\n".
        "在这里，您可以快速发现英语学习漏洞，足不出户享受专属线上服务或线下辅导，考取学霸分数！";
    }

    /**
     * 添加自定义菜单
     *
     * @return Collection|string
     */
    public function setMenu()
    {
        if (app()->environment() === 'local') {
            return 'skipping local environment';
        }

        Log::info('sending menu request.');

        $menu = $this->wechat->menu; // 获取菜单模块
        $buttons = [
            [
                "name"       => "乐学云",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "关于乐学云",
                        "url"  => "http://u1177627.jisuapp.cn/index.php?r=Invitation/showNewInvitation&id=1758970"
                    ],
                    [
                        "type" => "view",
                        "name" => "联系我们",
                        "url"  => "http://123.57.223.193/wecare/index/contact"
                    ],
                    [
                        "type" => "view",
                        "name" => "立即登录",
                        "url"  => "http://123.57.223.193/wecare/"  //route('wechat::auth.redirect')
                    ],
                ],
            ],
            [
                "name"       => "找老师",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "课程体验",
                        "url"  => "https://weui.io/#/"
                    ],
                    [
                        "type" => "view",
                        "name" => "名师介绍",
                        "url"  => route('m.students::teachers.index')
                    ],
                    [
                        "type" => "view",
                        "name" => "我的课程",
                        "url"  => route('m.students::lectures.index')
                    ],
                ],
            ],
            [
                "name"       => "直播课",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "直播课堂",
                        "url"  => "https://weui.io/#/"
                    ],
                    [
                        "type" => "view",
                        "name" => "精彩回放",
                        "url"  => "https://weui.io/#/"
                    ],
                ],
            ]
        ];

        return $menu->add($buttons);
    }

    /**
     * 修改账号所属行业
     *
     * @return boolean
     */
    public function setIndustry()
    {
        if (app()->environment() === 'local') {
            return 'skipping local environment';
        }

        Log::info('sending industry request.');

        $notice = $this->wechat->notice;
        return $notice->setIndustry(16, 1); // #16:教育->培训; #1:IT科技->互联网/电子商务
    }
}