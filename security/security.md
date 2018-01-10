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
以s作为私钥进行AES,DES等对称加密


>隐藏服务器信息

