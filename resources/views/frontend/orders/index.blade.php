@extends('frontend.layouts.app')

@section('content')
    <div class="ibox">
        <div class="ibox-title">
            <h5>所有订单</h5>
        </div>
        <div class="ibox-content">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>订单状态</th>
                    <th>购买时间</th>
                    <th>课时数量</th>
                    <th>教师</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="project-status">
                            @if($order->paid)
                                <span class="label label-default">已付款</span>
                            @else
                                <span class="label label-primary">待付款</span>
                            @endif
                        </td>
                        <td>
                            {{ humanDateTime($order->created_at) }}
                        </td>
                        <td class="text-left">
                            {{ $order->lectures->count() }}
                        </td>
                        <td class="text-left">
                            <a href="{{ route('students::teachers.show', $order->teacher_id) }}">{{ $order->teacher->name }}</a>
                        </td>
                        <td class="project-actions">
                            <a href="{{ route('students::orders.show', $order->id) }}" class="text-primary"> 查看详情 </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection