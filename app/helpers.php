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
    $isMobile = starts_with(Request::getHost(), 'm.');

    return $isMobile;
}

/**
 * Determine the user type from the request. Can be 'students', 'teachers' or 'admins'
 *
 * @return \Illuminate\Routing\Route|object|string
 */
function userType()
{
    return str_replace('m.', '', domainPrefix());
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
        $prefix = 'backend.';
    } elseif ($userType === 'students') {
        $prefix = isWechat() ? 'wechat.' : 'frontend.';
    }

    return $prefix;
}

/**
 * Fall back to a default placeholder if not set
 *
 * @param $path
 * @param $preset
 * @return string
 */
function getAvatarUrl($path, $preset)
{
    if ($path) {
        return $path . '?p=' . $preset;
    }

    return config('default_files.avatar') . '?p=' . $preset;
}

function getVideoUrl($path)
{
    if (!$path) {
        $path = 'videos/' . ltrim(config('default_files.video'),'/');
    }

    return url($path);
}

/**
 * @param $route
 * @return bool
 */
function isPageActive($route)
{
    if ($bct = \Page::bct()) {
        $activeRoutes = $bct->pluck('route');
        return $activeRoutes->contains($route);
    }

    return false;
}

/**
 * Convert Carbon timestamps to Chinese human readable format
 * TODO this package is quite limited. Need to write own formatter.
 *
 * @param $timestamp
 * @return string
 */
function humanDateTime($timestamp)
{
    return Carbon::parse($timestamp)->format('m月j日, l, h:i A');
}

function humanTime($timestamp)
{
    return Carbon::parse($timestamp)->format('h:i A');
}

function humanDate($timestamp, $dayOfWeek = false)
{
    $date = Carbon::parse($timestamp)->format('m月j日');

    if ($dayOfWeek) {
        $date .=  ', ' . humanDayOfWeek(Carbon::parse($timestamp)->dayOfWeek);
    }

    return $date;
}

function humanDayOfWeek($dayNumber)
{
    return trans('times.day_of_week.' . $dayNumber);
}

/**
 * Generate absolute path to route file given the file name
 * All route files are stored in app\Http\Routes
 *
 * @param $file
 * @return string
 */
function routeFile($file)
{
    return app_path('Http' . DIRECTORY_SEPARATOR . 'Routes' . DIRECTORY_SEPARATOR . $file);
}

/**
 * Pads nested arrays to be of equal length resursively
 *
 * @param array|\Illuminate\Support\Collection $array
 * @return array
 */
function padArray($array)
{
    $length = 0;

    /* first we get the max length */
    foreach ($array as $item) {
        if (! is_array($item) AND ! $item instanceof \Illuminate\Support\Collection) {
            continue;
        } elseif (count($item) > $length) {
            $length = count($item);
        }
    }

    if ($length === 0) {
        return $array;
    }

    /* now fill it up */
    foreach ($array as $item) {
        if (is_array($item) OR $item instanceof \Illuminate\Support\Collection) {
            fillArray($item, $length, '');
        }
    }

    return $array;
}

/**
 * @param array|\Illuminate\Support\Collection $array
 * @param int $length
 * @param null|mixed $filler
 * @return array
 */
function fillArray($array, int $length, $filler = null)
{
    if (count($array) < $length){
        $currentLength = count($array);
        for ($i = $currentLength; $i < $length; $i++) {
            $array[] = $filler;
        }
    }
}