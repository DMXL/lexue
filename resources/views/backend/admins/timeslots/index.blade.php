@extends('backend.layouts.app')

@section('content')
    <div class="ibox float-e-margins" id="timeslot-creation">
        <div class="ibox-content">
            <form role="form" class="form-horizontal" method="POST" action="{{ route('admins::timeslots.store') }}">
                {{ csrf_field() }}
                <div class="form-group m-b-none">
                    <label for="timeslot-start" class="control-label col-md-1 col-md-offset-1 col-xs-2">开始时间</label>
                    <div class="col-md-2 col-xs-4">
                        <div class="input-group">
                            <input name="start" id="timeslot-start" type="text" class="form-control" value="" v-model="timeslotStart">
                            <span class="input-group-addon">
                                <span class="fa fa-clock-o"></span>
                            </span>
                        </div>
                    </div>
                    <label for="timeslot-length" class="control-label col-md-1 col-xs-2">时长</label>
                    <div class="col-md-2 col-xs-4">
                        <select name="length" id="timeslot-length" class="form-control" v-model="timeslotLength">
                            <option value="30">30</option>
                            <option value="45">45</option>
                            <option value="60">60</option>
                        </select>
                    </div>
                    <label class="control-label col-md-1 col-xs-2">结束时间</label>
                    <div class="col-md-2 col-xs-4">
                        <div class="input-group">
                            <input type="text" class="form-control" :value="timeslotEnd" readonly>
                            <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-6 text-right">
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
        $(function() {
            $("#timeslot-start").pickatime({
                format: "HH:i"
            });
        });

        // Vue stuff
        new Vue({
            el: '#timeslot-creation',
            data: {
                timeslotStart: '',
                timeslotLength: ''
            },
            computed: {
                timeslotEnd() {
                    if (! this.timeslotStart || ! this.timeslotLength) {
                        return '';
                    } else {
                        return moment(this.timeslotStart, 'HH:mm').add(this.timeslotLength,'minutes').format('HH:mm');
                    }
                }
            }
        })
    </script>
@endsection