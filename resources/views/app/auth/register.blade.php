@extends('app.layouts.blank')

@section('content')
    <div>

        <h1 class="logo-name">{{ config('app.name') }}</h1>

    </div>

    <h3>注册</h3>

    <form class="m-t" role="form" method="POST" action="{{ route('register.post', userType()) }}">
        {{ csrf_field() }}
        <div class="form-group input-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"></i></span>
            <input type="text" class="form-control" placeholder="Username" name="name" value="{{ old('name') }}">
            @if ($errors->has('name'))
                <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group input-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <span class="input-group-addon"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i></span>
            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group input-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <span class="input-group-addon"><i class="fa fa-lock fa-fw" aria-hidden="true"></i></span>
            <input type="password" class="form-control" placeholder="Password" name="password">
            @if ($errors->has('password'))
                <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group input-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <span class="input-group-addon"><i class="fa fa-lock fa-fw" aria-hidden="true"></i></span>
            <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

        <p class="text-muted text-center"><small>Already have an account?</small></p>
        <a class="btn btn-sm btn-white btn-block" href="{{ route('login', userType()) }}">Login</a>
    </form>
@endsection