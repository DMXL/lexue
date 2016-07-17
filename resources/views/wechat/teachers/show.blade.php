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
                <a href="#tab3" class="weui_navbar_item">
                    购买课时
                </a>
            </div>
            <div class="weui_tab_bd">
                <div id="tab1" class="weui_tab_bd_item weui_tab_bd_item_active">
                    <article class="weui_article">
                        <section>
                            <p>{{ $teacher->years_of_teaching }}教龄&nbsp;&nbsp;授课年级: {{ $teacher->levels->implode('name', ',') }}</p>
                            <p>{{ $teacher->description }}</p>
                            <p>学生评价:</p>
                        </section>
                    </article>
                </div>
                <div id="tab2" class="weui_tab_bd_item">
                    <video controls>
                        <source src="{{ getVideoUrl($teacher->video) }}" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>
                </div>
                <div id="tab3" class="weui_tab_bd_item">
                    <h1 class="doc-head">购买课时!</h1>
                </div>
            </div>
        </div>
        <div class="bottombar">
            <div class="bottombar_text">
                ￥{{ $teacher->unit_price }}.00/课时（45分钟）
            </div>
            <a class="weui_btn weui_btn_mini weui_btn_primary">购买课时</a>
        </div>
    </div>
@endsection

@section('js')

@endsection