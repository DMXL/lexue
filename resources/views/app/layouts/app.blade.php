
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . " | " : "" }}{{ config('app.name') }}</title>

    <link href="{{ asset('app/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('app/css/style.css') }}" rel="stylesheet">

    @yield('head')

</head>

<body>

<div id="wrapper">

    @include('app.layouts.sidebar')

    <div id="page-wrapper" class="gray-bg">

        @include('app.layouts.header')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>{{ isset($title) ? $title : userTypeCn() . "后台" }}</h2>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">后台</a></li>
                    @if(isset($bct))
                        @each('partials.bct', $bct, 'link')
                    @endif
                    @if(isset($title))
                    <li class="active">
                        <strong>{{ $title }}</strong>
                    </li>
                    @endif
                </ol>
            </div>
        </div>

        @if(isset($customLayout) AND $customLayout)
            @yield('content')
        @else
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content animated fadeInUp">
                        @yield('content')
                    </div>
                </div>
            </div>
        @endif
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> {{ config('app.name') }} &copy; {{ Carbon\Carbon::now()->year }}
            </div>
        </div>

    </div>
</div>

<!-- Main scripts -->
<script src="{{ asset('app/js/all.js') }}"></script>

<!-- Custom scripts -->
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>

@yield('bottom')

</body>

</html>
