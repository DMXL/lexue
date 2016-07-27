<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="{{ route('auth::logout', userType()) }}">
                    <i class="fa fa-sign-out"></i> 退出登录
                </a>
            </li>
        </ul>
    </nav>
</div>