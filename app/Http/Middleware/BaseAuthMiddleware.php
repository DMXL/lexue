<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 7/07/16
 * Time: 3:43 PM
 */

namespace App\Http\Middleware;


class BaseAuthMiddleware
{
    protected $guard;

    /**
     * BaseAuthMiddleware constructor.
     */
    public function __construct()
    {
        $this->guard = userType();
    }
}