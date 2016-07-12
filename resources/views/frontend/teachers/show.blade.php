@extends('frontend.layouts.app')

@section('content')
    @unless($teacher)
        没有找到该老师的信息
    @endunless

    <div class="row">
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
                                @foreach($day as $hourKey => $time)
                                <?php $disabled = $time['disabled'] ?>
                                <div class="col-md-3 col-sm-6"{{ $disabled ? " disabled=disabled" : null }}>
                                    <div class="radio radio-info">
                                        <input type="radio" name="time"
                                               id="radio-{{ $dayKey }}-{{ $hourKey }}"
                                               value="{{ $time['time'] }}"{{ $disabled ? " disabled=disabled" : null }}
                                                v-model="picked"
                                        >
                                        <label for="radio-{{ $dayKey }}-{{ $hourKey }}">
                                        <?php $hour = $time['time']->hour ?>
                                        @if($disabled)
                                            <s>{{ $hour }}:00 - {{ $hour + 1 }}:00</s>
                                        @else
                                            {{ $hour }}:00 - {{ $hour + 1 }}:00
                                        @endif
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                                <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(authCheck())
                                    <div class="input-group">
                                    <span class="input-group-addon">选择的课时</span>
                                    <input type="text" class="form-control" :value="picked ? time : ''" readonly>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary">购买</button>
                                    </span>
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
        new Vue({
            el: '#time-table',
            data: {
                picked: ""
            },
            computed: {
                time() {
                    var date = new Date(this.picked);
                    var options = {
                        weekday: "long", year: "numeric", month: "short",
                        day: "numeric", hour: "2-digit", minute: "2-digit"
                    };
                    return date.toLocaleTimeString("zh-CN", options);
                }
            }
        })
    </script>
@endsection