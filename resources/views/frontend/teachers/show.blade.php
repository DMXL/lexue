@extends('frontend.layouts.app')

@section('content')
    @unless($teacher)
        没有找到该老师的信息
    @endunless

    <div class="row" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content no-background">
                    <div class="profile-image no-float">
                        <img src="{{ getAvatar($teacher->avatr, 'md') }}" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <h3>{{ $teacher->name }}</h3>
                    <p class="small">
                        {{ $teacher->description }}
                    </p>
                    <p class="small font-bold">
                        <span><i class="fa fa-circle text-navy"></i> Online status</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    @foreach(collect($timetable)->keys() as $index => $key)
                    <li{{ $index === 0 ? " class=active" : null }}>
                        <a data-toggle="tab" href="#tab-{{ $key }}">{{ trans('times.day_of_week.' . $key) }}</a>
                    </li>
                    @endforeach
                </ul>

                <form action="{{ route('students::teachers.book', $teacher->id) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="tab-content" id="time-table">
                    @foreach($timetable as $dayKey => $day)
                    <div id="tab-{{ $dayKey }}" class="tab-pane{{ $dayKey === 0 ? ' active' : null}}">
                        <div class="panel-body">
                            <div class="row">
                                @foreach($day as $value=> $time)
                                <?php $disabled = $time['disabled'] ?>
                                <div class="col-md-3 col-sm-6"{{ $disabled ? " disabled=disabled" : null }}>
                                    <div class="checkbox checkbox-primary">
                                        <input type="checkbox" name="times[]"
                                               id="timeslot-{{ $value }}"
                                               value="{{ $value }}"{{ $disabled ? " disabled=disabled" : null }}
                                               v-model="picked"
                                        >
                                        <label for="timeslot-{{ $value }}">
                                        @if($disabled)
                                            <s>{{ $time['range'] }}</s>
                                        @else
                                            {{ $time['range'] }}
                                        @endif
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    @if(authCheck())
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5 class="inline">选择的课程</h5>
                                        </div>

                                        <div class="ibox-content">
                                            <div class="row">
                                                <div class="col-md-6" v-if="selections.length" v-for="item in selections | orderBy 'time'">
                                                    <div class="alert alert-success">
                                                        <button class="close" type="button" v-on:click.stop="unselect(item.value)">×</button>
                                                        @{{ item.name }}
                                                    </div>
                                                </div>
                                                <div class="alert alert-danger" v-if="!selections.length">
                                                    还未添加任何课程
                                                </div>
                                            </div>
                                        </div>

                                        <div class="ibox-footer">
                                            <span class="pull-right">
                                                <button type="submit" class="btn btn-primary btn-sm pull-right">确认购买</button>
                                            </span>
                                        </div>
                                    </div>
                                    @else
                                        <div class="text-right">
                                            购买课程请先 <a href="{{ route('auth::login.get', ['user_type' => userType(), 'intended' => Request::getRequestUri()]) }}"
                                                     class="btn btn-primary btn-sm">登录</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                </form>
            </div>


        </div>
    </div>
@endsection

@section('js')
    <script>
        var vue = new Vue({
            el: '#time-table',
            data: {
                timetable: {!! json_encode(collect($timetable)->flatten(1)->toArray()) !!},
                picked: []
            },
            computed: {
                selections() {
                    var vm = this;
                    return this.picked.map(function(selection){
                        return {
                            name: vm.timetable[selection].string,
                            value : selection
                        };
                    })
                }
            },
            methods: {
                unselect(time) {
                    // trigger click on the checkbox
                    var index = this.picked.indexOf(time);
                    if (index > -1) {
                        this.picked.splice(index, 1);
                    }
                }
            }
        })
    </script>
@endsection