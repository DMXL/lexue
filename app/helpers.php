<?php

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
    return $userType;
}

/**
 * Returns the localized translation of user type
 *
 * @return string|\Symfony\Component\Translation\TranslatorInterface
 */
function userTypeCn()
{
    $sessionKey = 'user_type_cn';
    if (Session::has($sessionKey)) {
        return Session::get('user_type_cn');
    }

    $userTypeCn = trans('user.type.' . userType());
    Session::put($sessionKey, $userTypeCn);
    return $userTypeCn;
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
 * Check if environment is local
 *
 * @return bool
 */
function isLocal()
{
    return App::environment() === 'local';
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

function getAvatar($url, $preset)
{
    if ($url) {
        return $url . '?p=' . $preset;
    }

    return 'default/avatar.png?p=' . $preset;
}