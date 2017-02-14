<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 24/07/16
 * Time: 4:30 PM
 */

namespace App\Http\Controllers\Auth;


use App\Models\User\Student;
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

        $this->middleware($this->guestMiddleware());

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
     * Redirect the user to the wechat authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider()
    {
        return $this->wechatProvider->redirect();
    }

    /**
     * Obtain the user information from wechat.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback()
    {
        $wechatId = $this->wechatProvider->user()->id;

        $wechatUserService = app('wechat')->user;

        $wechatUser = $wechatUserService->get($wechatId);

        if (! Student::where('wechat_id', $wechatId)->exists()) {
            $user = new Student();
            $user->name = $wechatUser->get('nickname');
            $user->email = $wechatId . '@lexue.com';
            $user->wechat_id = $wechatId;
            $user->avatar = $wechatUser->get('headimgurl');
            $user->save();
        }

        if (! isset($user)) {
            $user = Student::where('wechat_id', $wechatId)->first();
        }

        \Auth::guard($this->guard)->loginUsingId($user->id, true);
        return redirect()->intended($this->redirectPath());
    }
}