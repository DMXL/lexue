@extends('wechat.layouts.blank')

@section('content')
    @unless($teacher)
        没有找到该老师的信息
    @endunless
    <div class="bd teachers_show" style="height: 100%;">
        <div class="weui_icon_area">
            <img src="{{ getAvatarUrl($teacher->avatar, 'md') }}" class="avatar" />
            <h2 class="weui_msg_title">{{ $teacher->name }}</h2>
        </div>
        <div class="weui_tab">
            <div class="weui_navbar">
                <a href="#tab1" class="weui_navbar_item weui_bar_item_on">
                    教师简介
                </a>
                <a href="#tab2" class="weui_navbar_item">
                    试听课程
                </a>
                <a id="purchase_tab" href="#tab3" class="weui_navbar_item">
                    购买课时
                </a>
            </div>
            <div class="weui_tab_bd">
                <div id="tab1" class="weui_tab_bd_item weui_tab_bd_item_active">
                    <article class="weui_article">
                        <section>
                            <p>{{ $teacher->years_of_teaching }}教龄&nbsp;&nbsp;授课年级: {{ $teacher->pretty_levels }}</p>
                            <p>{{ $teacher->description }}</p>
                            <p>学生评价:</p>
                        </section>
                    </article>
                </div>
                <div id="tab2" class="weui_tab_bd_item">
                    <video loop id="teachers_video">
                        <source src="/videos/sudointro.mp4" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>
                </div>
                <div id="tab3" class="weui_tab_bd_item">
                    <div>
                        <div class="calendar">
                            @foreach(collect($timetable) as $dayOfWeek => $day)
                                <a class="calendar_day select">
                                    <span class="date">{{ Carbon::parse($day['date'])->day }}</span><br />
                                    <span class="dayow">{{ trans('times.day_of_week.' . $dayOfWeek) }}</span>
                                </a>
                                <input type="hidden" name="times[]" class='select_input' id="{{ $dayOfWeek }}" />
                            @endforeach
                        </div>
                    </div>
                    <form action="{{ route('students::teachers.book', $teacher->id) }}" method="POST">
                        <div class="course_list">
                            <div class="weui_cells_title">已选课程</div>
                            <div class="weui_cells weui_cells_access">
                                <p class="weui_cell_desc">你还未选择任何课程</p>
                                @foreach(collect($timetable) as $dayOfWeek => $day)
                                    <div class="coursegroup" id="group_{{ $dayOfWeek }}"></div>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="bottombar">
            <div class="bottombar_text">
                {{ $teacher->price }}/课时（45分钟）
            </div>
            <button type="submit" id="purchase" class="weui_btn weui_btn_mini weui_btn_primary">购买课时</button>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Hashtag定位
        // var hash = window.location.hash;

        // 点击tab事件
        $('.weui_navbar_item').click(function() {
            var tab = $(this).attr('href');

            switch(tab) {
                case '#tab1':
                    $('.select_input').select('close');
                    $('#teachers_video')[0].pause();
                    break;
                case '#tab2':
                    $('.select_input').select('close');
                    $('#teachers_video')[0].play();
                    break;
                case '#tab3':
                    $('#teachers_video')[0].pause();
                    break;
            }
        });

        // 点击'购买课程'事件
        $('#purchase').click(function() {
            if($('.weui_bar_item_on').attr('href') != '#tab3')
                $('#purchase_tab').click();
        });

        // 课时选择selector
        var timetable = new Array();
        timetable = {!! json_encode($timetable) !!};

        for (var dayOfWeek in timetable) {
            var times = new Array();
            var timesWithKeys = timetable[dayOfWeek]['times'];

            for (var value in timesWithKeys) {
                times.push(timesWithKeys[value]);
            }

            $('.select_input#' + dayOfWeek).select({
                title: "请选择课程时间",
                multi: true,
                items: times,
                dow: dayOfWeek,
                onClose: function(callback) {
                    if(callback) {
                        var group_id = callback.dow;
                        var titles = callback.titles.split(',');
                        var values = callback.values.split(',');
                        var appendix = '';

                        if(callback.length == 0) {
                            $('#group_'+group_id).html('').removeClass('nonempty');
                        }
                        else {
                            $.toptip(dayToDay(group_id)+'已添加'+callback.length+'个课程', 'success');
                            for (var index in titles) {
                                appendix += '<a class="weui_cell" href="javascript:;">\
                                    <div class="weui_cell_bd weui_cell_primary">\
                                        <p>'+values[index].split('--')[0]+'&nbsp;&nbsp;&nbsp;&nbsp;'+titles[index]+'</p>\
                                    </div>\
                                    <div class="weui_cell_ft">\
                                    </div>\
                                </a>';
                            }
                            $('#group_'+group_id).html(appendix).addClass('nonempty');
                        }

                        emptyCheck();
                    }
                },
            });
        }

        $('.select').click(function() {
            $(this).next().select('open');
        });

        function dayToDay(num) {
            switch(num) {
                case '1':
                    return '周一';
                    break;
                case '2':
                    return '周二';
                    break;
                case '3':
                    return '周三';
                    break;
                case '4':
                    return '周四';
                    break;
                case '5':
                    return '周五';
                    break;
                case '6':
                    return '周六';
                    break;
                case '0':
                    return '周日';
                    break;

            }
        }

        function emptyCheck() {
            if($('.course_list .weui_cells .nonempty').length == 0)
                $('.weui_cell_desc').show();
            else $('.weui_cell_desc').hide();
        }
    </script>
@endsection
