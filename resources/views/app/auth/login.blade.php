@extends('app.layouts.blank')

@section('content')
    <div>

        <h1 class="logo-name">Hi</h1>

    </div>

    <p>登录{{ userTypeCn() }}后台</p>

    <form class="m-t" role="form" method="POST" action="{{ route('login.post', userType()) }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i></span>
                <input type="email" class="form-control" placeholder="邮箱" name="email" value="{{ old('email') }}">
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

        <div class="form-group">
            <div class="checkbox checkbox-success text-left">
                <input name="remember" id="name" type="checkbox">
                <label for="name">
                    下次自动登录
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary block full-width m-b">登录</button>

        <a href="{{ route('reset', userType()) }}">忘记密码了？</a>

        <hr>

        <p class="text-muted text-center"><small>还不是{{ userTypeCn() }}？</small></p>
        <a class="btn btn-sm btn-white btn-block" href="{{ route('register', userType()) }}">成为{{ userTypeCn() }}</a>
    </form>
@endsection