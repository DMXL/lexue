<!--
 *
 * This page extends from blank.blade.php
 * The ASCII art is gone because we don't want to see them twice in one page that would be lame.
 *
-->
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ isset($title) ? $title . ' - ' : ''}}{{ appName() }}</title>

    <link href="{{ asset('wechat/css/weui.css') }}" rel="stylesheet">
    <link href="{{ asset('wechat/css/lewe.css') }}" rel="stylesheet">
</head>

<body>

<div>
    @yield('content')
</div>

<!-- Mainly scripts -->
<script src="{{ asset('app/js/all.js') }}"></script>

</body>

</html>