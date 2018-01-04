## requestHead
host:
单服务器单ip多网站,服务器复用(nginx)
gzip

## Apache
监听ip
单机多网卡  单网卡多IP 冗余

### httpd.conf
简化的xml
visualHost: 1.2.3.4:80
serverName baidu.com对应host
serverAlias otherbaidu.com
serverAdmin
documentRoot 网站根目录

### 端口
0-1023  保留
1024-65000 可用
80 http
25 smtp
22 ssh
21 ftp

防火墙 阻止特殊端口
非标端口 8000 8080 安全

###  多域名 单网页
CNAME
A baidu.com 1.2.3.4
CNAME otherbaidu.com baidu.com

1. 同时使用A记录
```
A baidu.com 1.2.3.4
A otherbaidu.com 1.2.3.4
```
 - 延时更低 减少一次跳转
 -

2. CNAME
```
A baidu.com 1.2.3.4
CNAME otherbaidu.com baidu.com
```
 - 两次DNS查询
 - 易于维护

#### dns ttl
30m/60m/1day

### ip变更
多重ip
1. 可暂时保留ip，使用ip映射，等待dns广播完成
2. 更换web host或vps,ip不可保留,重定向并等待dns广播完成
 - 301永久重定向
 - 302暂时重定向 www.foo.com->beta.foo.com

问题:数据库迁移

### web host root账号
安全问题:通过服务器bug获取完全读写权限
专用用户名运行专用服务器
644 对你可读写 对所有人可读 755  js/css/png/gif/html

suPhp 指定服务器执行用户
suexec suexecusergroup

### mod_rewrite
重定向缺点

 - 301被浏览器记住，永久重定向风险
 - 移动端网站 重定向延时 头信息太重

RewriteEngine On  
RewriteCond ${HTTP_HOST} !^www.baidu.com$ [NC]  
RewriteRule (.*) http://www.baidu.com/$1 [R=301,L]  

NC: no case 不区分大小写
$1保存pathname
R code
L last

.htaccess也可以定义

### form
```
<form action method>
    <input name="key" />
</form>

```

ssh
```bash
ssh servername
chmod a+r x.html
chmod 644 x.html
```

### php
解释型
性能
编译预缓存

php.ini

### get post
1. post提交参数不在url中
2. html post刷新重新提交 付款两次的问题
3. post隐藏参数
浏览器历史纪录get参数
服务器也会留下get url记录
一般服务器日志不会记录请求体内容
抓数据包也可查看post数据,所以post可以隐藏信息，但并不一定安全
4. post使用文件上传
5. get url长度限制
firefox:65000字符 safari/IE 1024
虽然http协议url长度没有限制 但浏览器实现有限制
post会先发送内容长度 然后服务器逐字节读取即可

### php
```php
<?php
	print "<pre>";
    print_r($_GET);
    print_r($_POST);
    print_r($_REQUEST);
    print "</pre>";
?>
```
php html可混编
php 多值提交[]问题 name必须以[]结尾
不要相信用户提交

php提供多级别错误处理,可在代码或ini文件中配置
- notice
- warning
- error

```
<?php
    error_reporting(E_ALL); //show notice and warn
    ini_set("display_errors",TRUE); //log and send to browser
?>
```
#### 条件
```php
<?php if(isset($_POST['summer'])): ?>
    <b>hello,summer!</b>
<?php endif ?>
```
#### 赋值
```php
<=php endif ?>
```

@符号错误抑制
```php
<?php if(@$_POST['summer']): ?>
    <b>hello,summer!</b>
<?php endif ?>
```

#### 用户可见文件
public权限
 - lib
 - etc
 - html(public)

### 文本数据库
xml
 - DTD校验
 - XML Schema校验
 - 搜索功能
 - XPath 无排序功能
 - XQuery
 - XSLT

csv tsv psv
 - 平面文件
 - 没有层级和嵌套关系

## 登陆校验

### X-Powered-By
隐藏语言版本
X代表扩展属性(http spec?)

### 跳转
 - 302 Location
 - 或者跳转一个页面,给出链接,以防不支持Location
 - meta refresh <meta>
 - js 跳转

### session
persistence
session是对页面的访问

使用hashTable或关联数组实现
PHPSESSID 通过分配cookie实现 大随机数
```
<?php

    $_GET
    $_POST
    $_REQUEST
    $_SESSION
?>
```

#### cookie嗅探
https->http问题
session劫持

 - https加密cookie
 - ssl性能问题导致成本问题
    - gmail全站ssl
    - 支付网站
    - 银行
    - 唯一ip (request.head.host也被加密)
 - tls

#### ip检测
3g,4g移动网络动态ip问题
代理服务器ip变动

