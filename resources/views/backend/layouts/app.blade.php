
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . " | " : "" }}{{ appName() }}</title>

    <link href="{{ elixir('app/css/all.css') }}" rel="stylesheet">
    <link href="{{ elixir('app/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('app/css/customs.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/datetimepicker/datetime-picker.css') }}" rel="stylesheet">

    @yield('css')

</head>

<body>

<div id="wrapper">

    @include('backend.layouts.sidebar')

    <div id="page-wrapper" class="gray-bg">

        @include('backend.layouts.header')

        @unless(isset($noHeading))
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>{{ isset($title) ? $title : userTypeCn() . "后台" }}</h2>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">{{ userTypeCn() }}后台</a></li>
                    @if($bct = \Page::bct())
                        @each('backend.partials.bct', $bct, 'node')
                    @endif
                </ol>
            </div>
        </div>
        @endunless

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    @include('partials.validation')
                    @yield('content')
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="pull-right">

            </div>
            <div>
                <strong>Copyright</strong> {{ appName() }} &copy; {{ Carbon\Carbon::now()->year }}
            </div>
        </div>

    </div>
</div>

<!-- Main scripts -->
<script src="{{ elixir('app/js/all.js') }}"></script>
<script src="{{ asset('plugins/datetimepicker/datetime-picker.min.js') }}"></script>
<script src="{{ asset('plugins/clipboard/clipboard.min.js') }}"></script>

<!-- Custom scripts -->
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')}});
</script>

@yield('js')

</body>

</html>
