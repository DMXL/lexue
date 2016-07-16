@extends('backend.layouts.app')

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <form role="form" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group m-b-none">
                    <label for="timeslot-day-part" class="control-label col-md-1 col-xs-2">时间段</label>
                    <div class="col-md-2 col-xs-10">
                        <select name="day_part" id="timeslot-day-part" class="form-control">
                            <option value="morning">上午</option>
                            <option value="afternoon">下午</option>
                            <option value="evening">晚上</option>
                        </select>
                    </div>
                    <label for="timeslot-start" class="control-label col-md-1 col-xs-2">开始</label>
                    <div class="col-md-2 col-xs-10">
                        <input type="text" name="from" placeholder="开始时间" id="timeslot-start" class="form-control">
                    </div>
                    <label for="timeslot-end" class="control-label col-md-1 col-xs-2">结束</label>
                    <div class="col-md-2 col-xs-10">
                        <input type="text" placeholder="结束时间" id="timeslot-end" class="form-control">
                    </div>
                    <div class="col-md-3 text-right">
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