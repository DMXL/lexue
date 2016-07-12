## 本地环境简要说明
- `php artisan key:generate` 生成一下key
- `env`文件中的数据库信息必填
- `env`文件中的`MAIL_SENDER_ADDRESS`,`MAIL_SENDER_NAME`,`TEST_ACCOUNT_EMAIL`,`TEST_ACCOUNT_PASSWORD`必填
- `php artisan migrate --seed` 或者`php artisan migrate:refresh --seed`重置数据库
- (optional)`php artisan clear-compiled && php artisan ide-helper:generate`生成`ide helper`文件，帮助开发
- `env`文件中`APP_DOMAIN`必填，请改成自己本地的主域名

## weChat开发注意事项

### 子域名
目前系统默认把`m.students.domain`作为微信端的学生区域，生成的url也在这个子域名下

### view文件
位置：`resources/views/wechat`
变量：参考`resources/views/frontend`

### assets文件
位置：`public/wechat`
例如：`public/wechat/css/xxx.css`

### routes
**wechat UI**和默认的**students web UI**共用一套`routes`和`controller`系统，唯一的区别是`route namespace`。
**students web UI**的`route namespace`为`teachers::`，**weChat UI**为`wechat::`。在生成url的时候请注意，例如：`route('wechat::teachers.index')`

***

想到再加
