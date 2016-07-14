<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ authUser()->name }}</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('auth::logout', userType()) }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            @each('backend.partials.menu', config('pages.' . userType()), 'node')
        </ul>

    </div>
</nav>