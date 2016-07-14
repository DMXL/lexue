<?php
    $children = isset($node['children']) ? $node['children'] : null;
    $userType = userType();
?>
<?php $route = $userType . '::' . $key ?>
<li class="{{ isPageActive($route) ? "active" : '' }}">
    <a href="{{ route($route) }}">
        <i class="fa fa-th-large"></i> <span class="nav-label">{{ $node['title'] }}</span>
        @if($children)
        <span class="fa arrow"></span>
        @endif
    </a>
    @if($children)
    <ul class="nav nav-second-level collapse">
        @foreach($children as $route => $child)
        <?php $route = $userType . '::' . $route ?>
        <li class="{{ isPageActive($route) ? 'active' : '' }}"><a href="{{ route($route) }}">{{ $child['title'] }}</a></li>
        @endforeach
    </ul>
    @endif
</li>