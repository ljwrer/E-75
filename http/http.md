# http
csrf
sql注入
dns配置

## enter google.com
look domain name
通过网关或路由器,使用ip地址连接 4字节32位(ipv4)
google.com -> ip address
40亿ip地址
dns服务器  isp dns服务器
多层dns服务器+缓存
缓存问题: ip地址变更(可规模性)
```
domain = 'google.com'
ip = dns(domain)
router(ip)-http->domain

```

## http
无状态协议
ssh,ftp有状态协议

## 购买域名
go daddy
顶级域名
图瓦卢 .tv

域名注册商 dns服务器地址(从web host得到) 域名--ip

## web host
shell:ssh,sftp
网络界面

dream host
容量过销售
```
host->dns server address (ns1.dreamhost.com ns2.dreamhost.com)
```
1. 购买域名
2. 选购网络主机
3. 告诉域名注册商dns服务器
4. 设置网站

xampp/mamp/lamp

apache//iis//lighttpd，nginx

## dns记录
ns记录
MX记录 邮件 mail server(s) ip
  多记录 #10 #20 #30 #40
邮件外包:gmail

A记录  域名->ip

CNAME记录 别名记录 域名->域名  无需硬编码ip

先建立A记录
cs75.net  A:2.3.4.5
mail.cs75.net  CNAME: hs.google.com

```
domain(CNAME)->domain->ip
```

CNAME 间接连接
连接延时更长 多倍时间 使用缓存加速

A记录

static public ip
vps(多核cpu)

css漏洞查询用户历史记录  蓝色->紫色 连接

## request head
Host:多域名 单ip复用

ssl  ip地址唯一 加密http后 host也被加密
200
cache-control

ssh
sftp

分离静态资源  缓存  首次载入延迟

移动设备 并发
tcp keep alive



