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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' - ' : ''}}{{ appName() }}</title>

    <link href="{{ asset('wechat/lib/jquery.mobile-1.4.5.min.css') }}" rel="stylesheet">
    <!--
    <link href="{{ asset('wechat/css/weui.css') }}" rel="stylesheet">
    <link href="{{ asset('wechat/css/jquery-weui.css') }}" rel="stylesheet">
    <link href="{{ asset('wechat/css/lewe.css') }}" rel="stylesheet">
    -->
</head>

<body>

<div>
    @yield('content')
</div>

<!-- Mainly scripts -->
<script src="{{ asset('wechat/lib/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('wechat/lib/jquery.mobile-1.4.5.min.js') }}"></script>
<!--
<script src="{{ asset('wechat/js/jquery-weui.js') }}"></script>
<script src="{{ asset('wechat/js/lewe.js') }}"></script>
-->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
    });
</script>

</body>

</html>