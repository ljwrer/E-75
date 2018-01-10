# javascript
### 云mysql

### session劫持
cookie未通过ssl(https)传输
https开支和性能
vpn(加密通信)，离开vpn后不安全  client-(safe)-vpn-(danger)-server
中间人攻击
ssl加速器:
 - ssl专用硬件
 - ssl服务器,ssl集群
 - 前端为ssl服务器，后端为普通web服务器，最后为应用服务器和数据库服务器

基于IP和cookie的校验方式不适合NAT环境，因为攻击者和用户的公网ip很可能一致
JavaScript可以部分加密cookie

HAProxy:负载均衡,随机转接到多个vm
给云mysql设立域名并dns广播到多个vm(或修改host文件 ),方便连接
>my.cnf设置默认连接的数据库

### js文档
 - mdn
 - w3schools

通过http,js和php可相互调用



### 标签加载
 - 目录问题
 - 额外的http请求
 - 可缓存
    - 缓存更新问题
    - cache-control:max-age
    - cache-control,last-modify  -> if-modified-since
    - cache-control,etag -> if-none-match

#### noscript
当前已不适用,不如直接建立一个纯html版本

可多线程加载js

#### regexp
取舍:清晰表达式和完美表达式