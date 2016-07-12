<div class="row border-bottom white-bg">
    <nav class="navbar navbar-static-top" role="navigation">
        <div class="navbar-header">
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                <i class="fa fa-reorder"></i>
            </button>
            <a href="#" class="navbar-brand">{{ appName() }}</a>
        </div>
        <div class="navbar-collapse collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a role="button" href="{{ route('students::teachers.index') }}">找老师</a>
                </li>
                <li class="dropdown">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item <span class="caret"></span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="">Menu item</a></li>
                        <li><a href="">Menu item</a></li>
                        <li><a href="">Menu item</a></li>
                        <li><a href="">Menu item</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item <span class="caret"></span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="">Menu item</a></li>
                        <li><a href="">Menu item</a></li>
                        <li><a href="">Menu item</a></li>
                        <li><a href="">Menu item</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item <span class="caret"></span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="">Menu item</a></li>
                        <li><a href="">Menu item</a></li>
                        <li><a href="">Menu item</a></li>
                        <li><a href="">Menu item</a></li>
                    </ul>
                </li>

            </ul>
            <ul class="nav navbar-top-links navbar-right">
                @if(authCheck())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ authUser()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('students::profile.get') }}"><i class="fa fa-btn fa-user fa-fw"></i> 帐号</a></li>
                        <li><a href="{{ route('students::lectures.index') }}"><i class="fa fa-btn fa-book fa-fw"></i> 课程</a></li>
                        <li><a href="{{ route('auth::logout', userType()) }}"><i class="fa fa-sign-out fa-fw"></i> 退出</a>
                        </li>
                    </ul>
                </li>
                @else
                    <li><a href="{{ route('auth::login.get', userType()) }}">登录</a></li>
                    <li><a href="{{ route('auth::register.get', userType()) }}">注册</a></li>
                @endif
            </ul>
        </div>
    </nav>
</div>