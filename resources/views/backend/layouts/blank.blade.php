<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ isset($title) ? $title . ' - ' : ''}}{{ appName() }}</title>

    <link href="{{ asset('app/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('app/css/style.css') }}" rel="stylesheet">
</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    @yield('content')
    <p class="m-t"> <small>{{ appName() }} &copy; {{ Carbon\Carbon::now()->year }}</small> </p>
</div>

<!-- Mainly scripts -->
<script src="{{ asset('app/js/all.js') }}"></script>

</body>

</html>