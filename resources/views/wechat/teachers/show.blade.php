<!--
*
*
*   ______                        _____           __
*  /_  __/__  ____ _____ ___     / ___/__  ______/ /___
*   / / / _ \/ __ `/ __ `__ \    \__ \/ / / / __  / __ \
*  / / /  __/ /_/ / / / / / /   ___/ / /_/ / /_/ / /_/ /
* /_/  \___/\__,_/_/ /_/ /_/   /____/\__,_/\__,_/\____/
*
*
*
* Filename->index.blade.php
* Project->lexue
* Description->This is the view for lectures.
*
* Created by DM on 16/7/12 下午3:16.
* Copyright 2016 Team Sudo. All rights reserved.
*
-->
@extends('wechat.layouts.blank')

@section('content')

    @unless($teacher)

        没有找到该老师的信息

    @endunless

    <div class="bd teachers_show" style="height: 100%;">
        <form id="courses_form" action="{{ route('m.students::teachers.book', $teacher->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="weui_icon_area">
                <img src="{{ $teacher->avatar->url('medium') }}" class="avatar" />
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
                        <video id="teachers_video" src="{{ $teacher->video->url() }}"></video>
                        @else
                            <video id="teachers_video" src="/defaults/videos/{{ config('default_files.video') }}"></video>
                        @endif
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
                        <div class="course_list">
                            <div class="weui_cells_title">已选课时</div>
                            <div class="weui_cells weui_cells_access">
                                <p class="weui_cell_desc">你还未选择任何课程</p>
                                @foreach(collect($timetable) as $dayOfWeek => $day)
                                    <div class="coursegroup" id="group_{{ $dayOfWeek }}"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottombar">
                <div class="bottombar_text">
                    {{ $teacher->price }}/课时（45分钟）
                </div>
                <a id="purchase" class="weui_btn weui_btn_mini weui_btn_primary">购买课时</a>
            </div>
        </form>
    </div>

@endsection

@section('js')

    @include('wechat.snippets.alert')

    <script>
        // Hash路由
        routie({
            ':tab': function(tab) {
                $('a[href=#' + tab + ']').click();
            }
        });

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
                    break;
                case '#tab3':
                    $('#teachers_video')[0].pause();
                    break;
            }
        });

        // 课时选择selector
        var timetable = {!! json_encode($timetable) !!};

        var courseCount = 0;

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

                        courseCount += callback.offset;
                        emptyCheck();
                    }

                    updateBottomBar(courseCount);
                },
            });
        }


        // 点击日期事件
        $('.select').click(function() {
            $(this).next().select('open');
        });

        // 星期几数字转汉字工具
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

        // 课程列表空检查工具
        function emptyCheck() {
            if($('.course_list .weui_cells .nonempty').length == 0) {
                $('.weui_cell_desc').show();
                return true;
            } else {
                $('.weui_cell_desc').hide();
                return false;
            }
        }

        // 底栏更新工具
        function updateBottomBar(count) {
            var unitPrice = {!! json_encode($teacher->unit_price) !!};
            $('.bottombar_text').html('已选' + count +'课时，共' + (count * unitPrice) + '元');
        }

        // 点击'购买'按钮事件
        $('#purchase').click(function() {
            var currenttab = $('.weui_bar_item_on').attr('href');

            if(currenttab != '#tab3') {
                $('#purchase_tab').click();
            }
            else {
                if(emptyCheck())
                    $.toptip('您还未选择课程', 'error');
                else {
                    $.showLoading("进入支付页面...");
                    $('#courses_form').submit();
                }
            }
        });
    </script>

@endsection
