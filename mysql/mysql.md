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