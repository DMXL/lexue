@extends('backend.layouts.app', ['noHeading' => true])

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Lexue Wechat</h5>
                    <div class="ibox-tools"></div>
                </div>
                <div class="ibox-content ibox-heading">
                    <h3>欢迎！这里是唯开乐学微课管理后台</h3>
                    <small>Beta Edition. Powered by TeamSudo®️</small>
                </div>
                <div class="ibox-content inspinia-timeline">

                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                2017.02.10
                                <br/>
                                <small class="text-navy">v0.5.0</small>
                            </div>
                            <div class="col-xs-7 content no-top-border">
                                <p class="m-b-xs"><strong>2月更新</strong></p>
                                <p>新增课表视图，同时更新了大量前后台UI设计，对数据库及部分代码结构进行了重构</p>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                2016.10.11
                                <br/>
                                <small class="text-navy">v0.3.0</small>
                            </div>
                            <div class="col-xs-7 content no-top-border">
                                <p class="m-b-xs"><strong>10月更新</strong></p>
                                <p>完成与微信支付对接，实现直播课支付</p>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                2016.09.13
                                <br/>
                                <small class="text-navy">v0.2.0</small>
                            </div>
                            <div class="col-xs-7 content no-top-border">
                                <p class="m-b-xs"><strong>8月更新</strong></p>
                                <p>完成直播课部分功能，与多贝云对接，可从后台创建多贝云直播教室</p>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                2016.08.05
                                <br/>
                                <small class="text-navy">v0.1.0</small>
                            </div>
                            <div class="col-xs-7 content no-top-border">
                                <p class="m-b-xs"><strong>7月第一次更新</strong></p>
                                <p>完成微课部分初步功能，微信端可浏览老师及选课，后台可添加老师管理课表</p>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                2016.07.07
                                <br/>
                                <small class="text-navy">Begin</small>
                            </div>
                            <div class="col-xs-7 content no-top-border">
                                <p class="m-b-xs"><strong>项目启动</strong></p>
                                <p>开始搞事情</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection