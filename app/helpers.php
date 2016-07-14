<?php

/**
 * Shortcut for obtaining the app name
 *
 * @return mixed
 */
function appName()
{
    return config('app.name');
}

/**
 * Get the application domain or one of the sub-domains.
 * Root domain must be set from the env file
 *
 * @param null|string $prefix
 * @return null|string
 */
function appDomain($prefix = null)
{
    if (is_null($prefix)) {
        return config('app.domain');
    }

    return $prefix . '.' . config('app.domain');
}

/**
 * Get the subd-domain component
 * Inverse of appDomain()
 *
 * @return string|null
 */
function domainPrefix()
{
    $host = Request::getHost();

    if ($host === appDomain()) {
        return null;
    }

    $hostWithoutRootDomain = str_replace(appDomain(), '', $host);
    return $hostWithoutRootDomain = rtrim($hostWithoutRootDomain, '.');
}

/**
 * Whether the request url begins with "m."
 *
 * @return bool
 */
function isWechat()
{
    $sessionKey = 'is_mobile';

    if (Session::has($sessionKey)) {
        return Session::get($sessionKey);
    }

    $isMobile = starts_with(Request::getHost(), 'm.');

    Session::put($sessionKey, $isMobile);
    return $isMobile;
}

/**
 * Determine the user type from the request. Can be 'students', 'teachers' or 'admins'
 *
 * @return \Illuminate\Routing\Route|object|string
 */
function userType()
{
    $sessionKey = 'user_type';

    if (Session::has($sessionKey)) {
        return Session::get($sessionKey);
    }

    $userType = str_replace('m.', '', domainPrefix());
    Session::put($sessionKey, $userType);

    if ($userType) {
        return $userType;
    }

    return 'students';
}

/**
 * Returns the localized translation of user type
 *
 * @return string|\Symfony\Component\Translation\TranslatorInterface
 */
function userTypeCn()
{
    return trans('user.type.' . userType());
}

/**
 * Returns the currently authenticated user by its type
 *
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 */
function authUser()
{
    return Auth::guard(userType())->user();
}

/**
 * Returns the id of the currently authenticated user by its type
 *
 * @return int|null
 */
function authId()
{
    return Auth::guard(userType())->id();
}

/**
 * Check if the current user type is logged in
 *
 * @return bool
 */
function authCheck()
{
    return Auth::guard(userType())->check();
}

/**
 * "backend" for teachers and admins
 * "wechat" for student views
 * "frontend" as a fallback for students
 *
 * @return string
 */
function viewPrefix()
{
    $prefix = "";
    $userType = userType();

    if ($userType === 'teachers' || $userType === 'admins') {
        $prefix = 'backend/';
    } elseif ($userType === 'students') {
        $prefix = isWechat() ? 'wechat/' : 'frontend/';
    }

    return $prefix;
}

/**
 * Fall back to a default placeholder if not set
 *
 * @param $url
 * @param $preset
 * @return string
 */
function getAvatar($url, $preset)
{
    if ($url) {
        return $url . '?p=' . $preset;
    }

    return '/default/avatar.png?p=' . $preset;
}

/**
 * This automatically determines if 'wechat' or 'web' views need to be used
 *
 * @param $path
 * @param array $data
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
 */
function frontendView($path, $data = [])
{
    /* sanitize */
    $path = preg_replace('/^(frontend|wechat)\./', '', $path);

    if (isWechat()) {
        return view('wechat.' . $path, $data);
    }

    return view('frontend.' . $path, $data);
}

function backendView($path, $data = [])
{
    $data['title'] = \Page::title();
    $data['bct'] = \Page::bct();

    return view($path, $data);
}

function isPageActive($route)
{
    $activeRoutes = \Page::bct()->pluck('route');

    return $activeRoutes->contains($route);
}