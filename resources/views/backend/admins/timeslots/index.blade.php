@extends('backend.layouts.app')

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <form role="form" class="form-horizontal" method="POST" action="{{ route('admins::timeslots.store') }}">
                {{ csrf_field() }}
                <div class="form-group m-b-none">
                    <label for="timeslot-start" class="control-label col-md-1 col-md-offset-1 col-xs-2">开始时间</label>
                    <div class="col-md-3 col-xs-10">
                        <div class="input-group clockpicker" data-autoclose="true">
                            <input name="start" id="timeslot-start" type="text" class="form-control" value="" >
                            <span class="input-group-addon">
                                <span class="fa fa-clock-o"></span>
                            </span>
                        </div>
                    </div>
                    <label for="timeslot-end" class="control-label col-md-1 col-xs-2">结束时间</label>
                    <div class="col-md-3 col-xs-10">
                        <div class="input-group clockpicker" data-autoclose="true">
                            <input name="end" id="timeslot-end" type="text" class="form-control" value="" >
                            <span class="input-group-addon">
                                <span class="fa fa-clock-o"></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2 text-right">
                        <button class="btn btn-white" type="submit"><i class="fa fa-plus"></i> 添加课时</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="ibox">
        <div class="ibox-content">
            <div class="row m-b-lg m-t-lg">
                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <?php $dayParts = $timeslots->keys() ?>
                        @foreach($dayParts as $dayPart)
                        <th class="text-center">
                            {{ $dayPart }}
                        </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($timeslots->first() as $index => $timeslot)
                        <tr>
                        @foreach($dayParts as $dayPart)
                            <td>
                                @if($timeslots[$dayPart][$index])
                                    {{ $timeslots[$dayPart][$index]->range }}
                                @endif
                            </td>
                        @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.clockpicker').clockpicker();
    </script>
@endsection