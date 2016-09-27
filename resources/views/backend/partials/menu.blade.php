<?php
    $children = isset($node['children']) ? $node['children'] : null;
?>
<li class="{{ $node['active'] ? "active" : '' }}">
    <a href="{{ isset($node['route']) ? route($node['route']) : '#' }}">
        <i class="fa fa-{{ $node['icon'] }}"></i> <span class="nav-label">{{ $node['title'] }}</span>
        @if($children)
        <span class="fa arrow"></span>
        @endif
    </a>
    @if($children)
    <ul class="nav nav-second-level collapse">
        @foreach($children as $child)
        <li class="{{ $child['active'] ? 'active' : '' }}"><a href="{{ route($child['route']) }}">{{ $child['title'] }}</a></li>
        @endforeach
    </ul>
    @endif
</li>