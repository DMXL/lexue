<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{ authUser()->name }}</strong>
                            </span>
                            <span class="text-muted text-xs block">{{ userTypeCn() }} </span>
                        </span>
                    </a>
                </div>
                <div class="logo-element">
                    Lx
                </div>
            </li>
            @each('backend.partials.menu', $menu, 'node')
        </ul>

    </div>
</nav>