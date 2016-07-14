@if(isset($node['end']) AND $node['end'])
    <li class="active">
        <strong>{{ $node['title'] }}</strong>
    </li>
@else
    <li>
        <a href="{{ route($node['route']) }}">{{ $node['title'] }}</a>
    </li>
@endif