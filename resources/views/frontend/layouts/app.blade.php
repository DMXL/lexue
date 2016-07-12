<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . " | " : "" }}{{ appName() }}</title>

    <link href="{{ asset('app/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('app/css/style.css') }}" rel="stylesheet">

    @yield('css')

</head>

<body class="top-navigation">

<div id="wrapper">

    <div id="page-wrapper" class="gray-bg">

        @include('frontend.layouts.header')

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    @include('flash::message')
                    @yield('content')
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> {{ appName() }} &copy; {{ Carbon\Carbon::now()->year }}
            </div>
        </div>

    </div>
</div>

<!-- Main scripts -->
<script src="{{ asset('app/js/all.js') }}"></script>

<!-- Custom scripts -->
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')}});
</script>

@yield('js')

</body>

</html>
