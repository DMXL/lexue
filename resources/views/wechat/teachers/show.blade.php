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
                            @foreach(collect($timetable)->keys() as $index => $dayOfWeek)
                                <a class="calendar_day select">
                                    <span class="date">{{ explode("-", (collect($timetable)->pluck('date')[$index]))[2] }}</span><br />
                                    {{ trans('times.day_of_week.' . $dayOfWeek) }}
                                </a>
                                <input type="hidden" class='select_input' id="{{ $dayOfWeek }}" />
                                <script>
                                    $('.select_input#{{ $dayOfWeek }}').select({
                                        title: "请选择课程时间",
                                        multi: true,
                                        items: {!! json_encode(array_values(collect($timetable)->pluck('times')[$index])) !!}
                                    });
                                </script>
                            @endforeach
                        </div>
                    </div>
                    <div class="course_list">
                        <div class="weui_cells_title">已选课程</div>
                        <div class="weui_cells weui_cells_access">
                            <p class="weui_cell_desc">你还未选择任何课程</p>
                        </div>
                        <!--
                        <div class="weui_cells weui_cells_access">
                            <a class="weui_cell" href="javascript:;">
                                <div class="weui_cell_bd weui_cell_primary">
                                    <p>cell standard</p>
                                </div>
                                <div class="weui_cell_ft">
                                </div>
                            </a>
                            <a class="weui_cell" href="javascript:;">
                                <div class="weui_cell_bd weui_cell_primary">
                                    <p>cell standard</p>
                                </div>
                                <div class="weui_cell_ft">
                                </div>
                            </a>
                        </div>
                        -->
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
        $('.select').click(function() {
            $(this).next().select('open');
        });
    </script>
@endsection
