# lexue <font size=4>v0.5.1</font>

微信在线课程管理平台，基于 `Laravel 5.2` 开发。

### 开发及测试环境

* 本地: MacOS10.12 + Homestead
* 线上: Ubuntu16.04 + Forge

### 核心功能

- PC端对教师、微课、直播课及课时安排和课表进行管理
- 微信端通过公众号实现课程的预约、购买及直播观看

### 工具及依赖

- [overtrue/laravel-wechat](https://github.com/overtrue/laravel-wechat) 微信公众平台及支付接口的SDK
- [多贝云API](http://docs.duobeiyun.com/) 多贝云直播课堂API
- [INSPINIA Admin Theme](https://wrapbootstrap.com/theme/inspinia-responsive-admin-theme-WB0R5L90S) 后台样式基于INSPINIA和Bootstrap 3
- [lihongxun945/jquery-weui](https://github.com/lihongxun945/jquery-weui) 微信端H5页面样式基于Jquery WeUI v0.8.3组件库

### 线上演示

请关注微信公众号

![image](https://github.com/thesudoteam/lexue/blob/master/public/images/qrcode_for_gh_bc197aa3e945_258.jpg)

### 更新日志

* 2017.02 v0.5.0: 新增课表视图，同时更新了大量前后台UI设计，对数据库及部分代码结构进行了重构
* 2016.10 v0.4.0: 完成与微信支付对接，实现直播课支付
* 2016.09 v0.3.0: 完成直播课部分功能，与多贝云对接，可从后台创建多贝云直播教室
* 2016.08 v0.2.0: 完成微课部分初步功能，微信端可浏览老师及选课，后台可添加老师管理课表
* 2016.07 v0.1.0: 开始搞事情

### License

[MIT License](https://opensource.org/licenses/MIT)