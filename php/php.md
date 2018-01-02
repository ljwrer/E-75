## requestHead
host:
单服务器单ip多网站,服务器复用(nginx)
gzip

## Apache
监听ip
单机多网卡  单网卡多IP 冗余

### httpd.conf
简化的xml
visualhost: 1.2.3.4:80
servername baidu.com
serveradmin
documentroot

端口
0-1023  保留
1024-65000 可用
80 http
25 smtp
22 ssh
21 ftp

防火墙 阻止特殊端口
非标端口 8000 8080 安全

