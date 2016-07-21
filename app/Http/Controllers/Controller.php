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
     * This automatically determines if 'wechat' or 'web' views need to be used
     *
     * @param $path
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function frontView($path, $data = [])
    {
        /* sanitize */
        $path = preg_replace('/^(frontend|wechat)\./', '', $path);

        if (isWechat()) {
            return view('wechat.' . $path, $data);
        }

        return view('frontend.' . $path, $data);
    }

    protected function backView($path, $data = [])
    {
        $data['title'] = \Page::title();
        $data['bct'] = \Page::bct();
        $data['menu'] = \Page::menu();

        /* sanitize */
        $path = preg_replace('/^(backend)\./', '', $path);

        return view('backend.' . $path, $data);
    }

    protected function frontRedirect($route)
    {
        /* sanitize */
        $route = preg_replace('/^(students|wechat)::/', '', $route);

        if (isWechat()) {
            return redirect()->route('wechat::' . $route);
        }

        return redirect()->route('students::' . $route);
    }
}
