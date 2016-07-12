<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    /**
     * @param string $path Absolute or relative to 'frontend' or 'wechat'
     * @param null $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function frontendView($path, $data = [])
    {
        /* sanitize */
        $path = preg_replace('/^(frontend|wechat)\./', '', $path);

        if (isWechat()) {
            return view('wechat.' . $path, $data);
        }

        return view('frontend.' . $path, $data);
    }
}
