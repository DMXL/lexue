@extends('frontend.layouts.app')

@section('content')
    @foreach($teachers as $teacher)
        <div class="col-lg-4">
            <div class="contact-box">
                <a href="profile.html">
                    <div class="col-sm-4">
                        <img alt="image" class="img-circle m-t-xs img-responsive" src="{{ getAvatar('', 'sm') }}">
                        <div class="m-t-xs font-bold">￥{{ $teacher->unit_price }}.00/时</div>
                    </div>
                    <div class="col-sm-8">
                        <h3><strong>{{ $teacher->name }}</strong> - <small>{{ $teacher->levels->implode('name', ',') }}</small></h3>
                        <p>{{ str_limit($teacher->description, 40) }}</p>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </div>
        </div>

    @endforeach
@endsection