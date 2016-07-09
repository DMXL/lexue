@extends('backend.layouts.blank')

@section('content')
    <div>

        <h1 class="logo-name">Hi</h1>

    </div>

    <p>重置{{ userTypeCn() }}帐号密码</p>

    <form class="m-t" role="form" method="POST" action="{{ route('auth::reset.post', userType()) }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i></span>
                <input type="email" class="form-control" placeholder="邮箱" name="email" value="{{ $email or old('email') }}">
            </div>
            @if ($errors->has('email'))
                <span class="help-block text-left">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock fa-fw" aria-hidden="true"></i></span>
                <input type="password" class="form-control" placeholder="密码" name="password">
            </div>
            @if ($errors->has('password'))
                <span class="help-block text-left">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock fa-fw" aria-hidden="true"></i></span>
                <input type="password" class="form-control" placeholder="确认密码" name="password_confirmation">
            </div>
            @if ($errors->has('password_confirmation'))
                <span class="help-block text-left">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary block full-width m-b">重置</button>
    </form>
@endsection
