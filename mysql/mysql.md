# mysql
防御式编程 假设用户会捣乱
sql注入 csrf
## 设计
 - index.php
 - header.php
 - footer.php

 - include
    - 文件不存在不会报错
 - require(filename)
    - require("header.php")
    - require("footer.php")
 - require_once
    - 文件有包含关系时,保证只调用一次

### _get
类似运算符重载与访问器属性，可定义属性和函数

### xPath
`/`:xml dom root
`//`:自己及后代
`child::${node-name}`轴(`child::`默认，可不写)
`[@attr=${attr}]`过滤(@是attribute::的缩写)
其他轴:
 - 父轴 parent::
 - 先代轴 ancestor::
 - 后代轴 descendant::


```xPath
<?php
    $dom = simplexml_load_file('characters.xml');
    $result = $dom->xpath("/child::characters/child::character[@id='Adol']");
    $result2 = $dom->xpath("/characters/character[@id='Adol']");
?>
```

使用查找表实现

### 换行
 - linux
    - `\n`
 - windows
    - `\r\n`
 - mac
    - `\r`

### csv
tsv:`\t tab`
psv:`|`
分隔符冲突:引号
```csv
a,b,c\n
d,e,f
```
>php:'!==和==='

 - fgetcsv
 - fputcsv

#### xml与csv
 - 可读性
 - xPath支持
 - 支持层级
 - 文件更大
 - 都缺乏访问控制

### sql语言
支持二进制文件 sqlite
不区分大小写,惯例为大写
 - CREATE
 - ALTER(修改)
 - DROP
 - 行操作
     - SELECT
     - INSERT
     - UPDATE
     - DELETE


### 语言支持
抽象函数集
- PDO
- JDBC
- ODBC

### phpMyAdmin
gui建库建表,数据操作,权限管理

### 关系型数据库
使用行和列的表存储数据
 - search
 - insert
 - delete
 - sort
 - join

### Field

### 数据库数据类型(Type)
 - varchar
    - 潜在风险
    - 255->65535字符
 - char
    - 固定长度
    - 性能更好,索引容易
    - 8 字符
 - TEXT
    - 64KB
    - Mysql支持全文搜索
        - 占用空间略大


#### 数据库设计决策
数据库层面的权限限制
代码和数据库层面都需要权限限制

### Collation(编码类型)
默认为瑞典语编码支持英文,默认即可

### Attributes
符号数设置，记住修改时间戳等功能

### Null
可否为空

### Default
默认值

### Extra
自增

### Index
建立索引,加速搜索,无须遍历整张表，但初始化稍慢,需要额外空间

#### Primary
主键 行唯一标识符 不要太长
#### Unique
唯一 但不是主键 如手机号码,身份证号码

### Fulltext
数据很大,如用户留言,方便全文搜索

### Storage Engine
类似文件系统，如hfs+,ntfs,fat32,数据库引擎也有不同格式,
Mysql默认为MySAM,不支持事务,多重查询,原子查询,常用
InnoDB支持事务,常用
MEMORY堆表,只存在内存,非持久化，适合排序和搜索
FEDERATED 大量数据,数据分区
ARCHIVE 压缩
CSV

#### sql保留字
group
重音符 \`

```sql
CREATE TABLE `ray`.`users` (
    `user` VARCHAR(255) NOT NULL,
    `pass` VARCHAR(255) NOT NULL
) ENGINE = MYISAM;
ALTER TABLE `users` ADD PRIMARY KEY[`user`];
INSERT INTO `users` (`user`, `pass`) VALUES ('ray', '123');
SELECT * FROM `users`;
SELECT user FROM `users`;
DELETE FROM `users` WHERE `users`.`user` = \'puff\';
ALTER TABLE `users` ADD INDEX( `user`, `pass`);
```
### join key
联合key,做到全局唯一

### php
```php
mysql_connect
mysql_error
die
mysql_query
mysql_num_rows
mysql_fetch_assoc //获取关联数组
```
查表只查找最小结果集
连接数据库同样需要时间
#### sql注入
防御式编程
#sprintf()
使用占位符
#mysql_real_escape_string()

sql query返回结果集

>区分数据库与数据库服务器
>区分空值

### httpd.conf
```
<VirtualHost *:80>
    Alias /0 "/home/username/projects/0/html"
    UseCanonicalName OFF
<VirtualHost/>
```

#### 权限
目录:701 711
php:600
css,html,js,img:644

### 密码加密
mysql函数

 - NOW()
    - 当前时间
 - PASSWORD
    - 加密(weak hash)
 - AES_ENCRYPT
    - 二进制加密
    - varbinary(255)
    - data
    - secret
    - 可限制密文长度
    - 迁移数据库文件容易出错
    - 一般将密码同时作为加密文本和密钥 AES(PWD,PWD)

SELECT 1 加速数据传输
缓存查询  结果在内存中

### sql服务器迁移
迁移.sql文件  注意二进制文件

挑选合适的数据类型,范围,性能,浮点和舍入问题
DATE注意时区

### join
分表查询,联合主键
>ID使用无符号数,倾向于使用基本类型，方便数据库移植
```sql
//inner join
SELECT drivers.name, times.* FROM times,drivers WHERE times.driver_id=drivers.id // 隐式
SELECT drivers.name, times.* FROM times JOIN drivers WHERE times.driver_id=drivers.id
//cross join(debug常用，展现所有的数据)
SELECT * FROM times CROSS JOIN users
//outer join
//left outer join(包含inner join内容，同时给出左表中无匹配的所有行,需要同时展示匹配结果和不匹配结果时使用)
SELECT drivers.name, times.* FROM drivers LEFT OUTER JOIN times on times.driver_id=drivers.id
SELECT COUNT(*) FROM drivers //length of drivers
SELECT * FROM dirvers ORDER BY drivers.name LIMIT 0,1
```
>谨慎的删除表中的数据，选择一个字段做标记是更好的选择
>动态属性应该存入被依赖值而不是动态值，如需要年龄的话应该存入生日
动态属性计算量不大且读取不频繁选择不存入

### 竞态条件
金融交易
```sql
INSERT INTO table (a,b,c) VALUES (1,2,3) ON DUPLICATE KEY UPDATE c=c+1
UPDATE table SET c=c+1 WHERE a=1;
```
### 事务
InnoDB
 - 保证操作的原子性
 - 避免竞态条件
 - 无时间差
 - commit才执行
 - 可rollback
 - 速度更慢
```sql
START TRANSACTION;
UPDATE account
    SET balance = balance - 1000 WHERE number = 2;
UPDATE account
    SET balabce = balance + 1000 WHERE number = 1;
COMMIT;
```
```sql
START TRANSACTION;
UPDATE account
    SET balance = balance - 1000 WHERE number = 2;
UPDATE account
    SET balabce = balance + 1000 WHERE number = 1;
SELECT balance
    FROM account WHERE number = 2;
# suppose account #2 has a negative balance!
ROLLBACK;
```

### 表格锁
MyISAM:锁定整张表，读锁定或写锁定
```sql
LOCK TABLES account WRITE;
SELECT balance FROM account WHERE number = 2;
UPDATE account
    SET balance = 1500 WHERE number = 2;
UNLOCK TABLES;
```

交易前检查用户余额

### 外键
在其他表中使用主键
InnoDB
>不太好维护，性能也不太好