<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AuthenticateWithWechat extends BaseAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param null|string $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard ? : $this->guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } elseif (app()->environment() !== 'local' AND isWechat()) {
                return redirect()->route('wechat::auth.redirect');
            }
        }

        return $next($request);
    }
}
