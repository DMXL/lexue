<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 24/07/16
 * Time: 4:30 PM
 */

namespace App\Http\Controllers\Auth;


use Overtrue\Socialite\SocialiteManager;

class WechatAuthController extends AuthController
{


    /*
    |--------------------------------------------------------------------------
    | Wechat related auth
    |--------------------------------------------------------------------------
    */
    /**
     * @var \Overtrue\Socialite\Providers\WeChatProvider
     */
    private $wechatProvider;

    /**
     * WechatAuthController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $socialiteManager = new SocialiteManager([
            'wechat' => [
                'client_id'     => config('wechat.app_id'),
                'client_secret' => config('wechat.secret'),
                'redirect'      => route('wechat::auth.callback'),
            ],
        ]);

        $this->wechatProvider = $socialiteManager->driver('wechat')->scopes(config('wechat.oauth.scopes'));
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider()
    {
        return $this->wechatProvider->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return
     */
    public function handleProviderCallback()
    {
        dd($user = $this->wechatProvider->user());

        // $user->token;
    }
}