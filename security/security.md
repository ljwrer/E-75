# 安全
共享环境中的潜在威胁
## sql注入
mysql_real_escape_string
mysqli
## telnet
ssh的始祖，远程连接,明文传输
fas邮件
有线连接

hub(集线器) 通信广播给所有接入hub的用户  嗅探同一个hub的用户  网卡混杂模式
当前用于有线连接路由器和交换机

## ftp
文件上传下载,用户名密码用明文传输
不购买支持ftp的服务器
>sftp:ftp over ssh


## http
fireSheep:session劫持 嗅探局域网http

## mysql
用户名密码用明文传输
1. 包过滤 在传输层或网络层控制访问
2. ssh 支持远程开发
    - tcp:3306->ssh->mysql server

## 共享环境权限问题
1. suPHP,fastCgi
以用户权限运行服务端代码
性能代价
2. 专用服务器或VM
 - 文件服务器
 - LDAP服务器

## session劫持
### session
```
Set-Cookie:PHPSESSID=atljeb55o426puei1mdovj6iq3; path=/
```
hashTable
储存在/temp文件夹下,文件名为sess_${big_random_number}的文本文件存放$_SESSION变量
也可存在数据库中

### 劫持
嗅探无线网络或浏览历史偷走session_id
NAT公用ip,服务器无法通过ip识别用户
MAC地址可能重复
tcp端口号也是明文

NAT源端口可能可以进行加密
 - 不同用户的NAT源端口不一致
    - NAT也会使用session标记用户,所以公网ip+NAT session能唯一标记用户
 - TCP层加密

#### fireSheep/Idiocy
嗅探网络->筛选host->读取cookie->伪造身份

### https
1. session cookie:secure
2. 全站只支持https

### 无线网路安全
wep wpa wpa2
wpa2:用户与无线接入点之间加密传输
但接入点后面的路由器可能用明文传输

### 用户层防御
#### force-tls/https-everywhere
#### vpn
ssl based vpn
vpn到服务器之间仍然未加密
##### iVpn/openVpn
固定ip或dns做动态映射，自建vpn

### wireShark
网络嗅探工具 tcp,http
数据解释软件

>多重NAT容易导致网络混乱,access port only

## 物理接入攻击
文件加密:fileVault
## session固定
伪造session
增长session长度

## session更新
快速更新session,减少被攻击的间隔，也可能导致用户的session被强制失效

# ssl
## ssl证书
1. 准备公钥和私钥,如openssl获取得到.key和.csr(证书签署请求)
2. 将.csr文件上传带CA(购买证书的地方),验证通过后得到另一个文本文件，包含公钥以及被CA私钥加密的数字签名
3. 在服务器配置添加证书
4. 用户请求https,相互到公钥，各自使用公钥加密交换一条信息。。。
5. 信任链:可信的ssl提供商

host加密问题:
 - 单ip
 - 多子域名
    - wildcard证书

## RSA
公钥加密
RAS类似DLP
### DLP(diffie-hellman)加密
Alice -- Bob
Alice生成随机数A
Bob生成随机数B
商定生成密钥的底数g,一个大质数p
g,p是完全公开的
Alice得到TA = Math.exp(g,A) mod p
Bob得到TB = Math.exp(g,B) mod p
Alice传出TA
Bob传出TB
TA,TB是完全公开的
Alice计算Math.exp(TB,A) mod p 得到key
Bob计算Math.exp(TA,B) mod p 得到key
key = Math.exp(g,AB) mod p
以key作为私钥进行AES,DES等对称加密


>隐藏服务器信息

## 跨域安全问题
### 同源策略
 - windows
 - frames
 - embedded objects
 - cookies
 - XmlHttpRequest

## csrf(cross site request forgery)
1. login to project2.domain.tld
2. visit bad guy's site
3. bad guy's site contains a link to http://project2.domain.tld/buy.php?symbol=INFX.PK
4. you buy some thing

### src csrf攻击
1. img,script,iframe伪造get请求
2. cors ajax伪造请求
3. form submit target iframe 伪造 post请求

 - 做一个确认页面提高门槛
 - post提高门槛
 - http referer(不是所有浏览器都发送referer)
 - 附加session token给url,服务器检查表单的token
 - session快速失效提高门槛
 - 验证码提高门槛
 - cors限定域名
 - 纯json通信(表单难以伪造)
 - 保持get幂等
 - 不使用get post
 - X-Frame-Options:禁止iframe

#### crfs token
session中保存一份token或token的hash
表单或ajax提交时带上token
服务器比对两个token即可

缺点:
    - 打开新页面可能更新session中的token导致之前打开的页面提交后token不一致
    - 如果被xss且使用表单get提交，token将写入url中,攻击者服务器能从referrer中取出url窃取token
        - 插入外链时写入 rel=noreferer
        - meta referrer设为never或origin隐藏token
laravel:
```php
<form method="POST" action="/profile">
    {{ csrf_field() }}
    ...
</form>
<meta name="csrf-token" content="{{ csrf_token() }}">

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
```


### xss
htmlspecialchars
忘记转义
当用户的输入被送回
UGC网站容易出现此问题 如微博

## https简易通信
假设使用AES和RSA
服务器生成一对公钥和私钥
```
＃生成私钥key文件
openssl genrsa 1024 > /path/to/private.pem
//
＃通过私钥文件生成CSR证书签名,包含公钥及一些必要信息
openssl req -new -key /path/to/private.pem -out csr.pem
```

将公钥及网站信息提交到CA
CA使用CA私钥加密服务器公钥及网站信息生成证书
```
openssl x509 -req -days 365 -in csr.pem -signkey /path/to/private.pem -out /path/to/file.crt
```
服务器部署私钥及证书
```
var privateKey  = fs.readFileSync('/path/to/private.pem', 'utf8');
var certificate = fs.readFileSync('/path/to/file.crt', 'utf8');
var credentials = {key: privateKey, cert: certificate};

var httpServer = http.createServer(app);
var httpsServer = https.createServer(credentials, app);
```

客户端生成随机数1请求服务器
服务器生成随机数2  返回证书
客户端使用CA公钥解密证书得到服务器公钥和服务器信息
客户端验证服务器公钥是否有效
验证通过
客户端生成随机数3(pre master key)
客户端根据3个随机数生成AES公钥
并使用公钥加密随机数3发送给服务器
服务器使用私钥得到随机数3
服务器根据3个随机数生成AES公钥

之后通信基于AES加密进行
