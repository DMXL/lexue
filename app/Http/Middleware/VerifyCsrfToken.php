<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    protected $except_routes = [
        'wechat::user_request'
    ];

    protected function shouldPassThrough($request)
    {
        if (in_array(\Route::currentRouteName(), $this->except_routes)) {
            return true;
        }

        return parent::shouldPassThrough($request);
    }
}
