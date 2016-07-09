@extends('backend.layouts.blank')

<!-- Main Content -->
@section('content')
    <div>

        <h1 class="logo-name">Hi</h1>

    </div>

    <p>重置{{ userTypeCn() }}帐号密码</p>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form class="m-t" role="form" method="POST" action="{{ route('auth::reset.email', userType()) }}">
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

        <button type="submit" class="btn btn-success block full-width m-b">发送重置链接</button>
    </form>
@endsection
