# xml
## sql
 - mysql
 - postgresql
 - access
 - oracel

## ui
《don't make me think》

## xml
 - root element
 - element (树结构)
    - child element
 - attribute
    - 可作主键
    - 解析比子元素快(树解析)
    - api调用简单
    - 属性不能被扩展，属性不能有子属性
    - 不太美观

 - 空白文本节点
 - 注释
    - `<!-- -->`
    - 不能包含`--`
 - 文档声明
    - `<?xml version="1.0" encoding="UTF-8"?>`
    - 与php短标签冲突,可以用echo hack
    - 非必须
    - 第一行,无空格,无回车
 - CDATA/PCDATA
    - 跳过解析,储存文本

 - 元素开头不能为数字
 - 元素可以包含元素
 - 默认不解析空白字符`\t\n`
 - 元素可以与文本混合
 - DTD/XML Schema定义结构
    - NMTOKEN
    - ID
    - IDREF
 - 单引号双引号皆可
 - 不能包含`<&` 转义为`&amp;  &lt; &#8211; &#8212;等`
    - url转义&
 - 实体字符
    - 内置5个:`&amp;&lt;&gt;&apos;&quot;`
    - 自定义:`<!ENTITY nbsp "&#160;">`
    - 可以表示三角形等字符，如版权标记`$#x00A9`
        - 标准字体实现
 - DOCUMENT结构类似html


新插入元素需要不影响既定元素运行

## 编码
编码表示利用二进制数表示字符的不同方式
UTF-8 ASCII 英文差不多,但亚洲象形文字差异极大

服务器层面，如apache设置的文件访问权限并不安全（如果服务器关闭）

### php
require import

### httpd.conf
alias

### php,XML
SimpleXML
php DOM
SAX Parser

### linux文件权限
 - d - 目录
 - rwx 可读写可执行
 - `-` 无权限

#### chmod修改权限
```
chmod a+x ..
```

### 引号
php区分单引号双引号
插入变量时使用双引号
```
 "<a href='$path' "   //ok
 '<a href="$path" '   //wrong
```

### 模板引擎
 - Smarty
 - CakePHP
 - CodeIgniter

### RSS
XML文件
```xml
<?xml version="1.0" encoding="gb2312"?>


<?xml-stylesheet type="text/xsl" href="/css/rss_xml_style.css"?>

<rss version="2.0">
  <channel>
    <title>新闻国内</title>
    <image>
      <title>新闻国内</title>
      <link>http://news.qq.com</link>
      <url>http://mat1.qq.com/news/rss/logo_news.gif</url>
    </image>
    <description>新闻国内</description>
    <link>http://news.qq.com/china_index.shtml</link>
    <copyright>Copyright 1998 - 2005 TENCENT Inc. All Rights Reserved</copyright>
    <language>zh-cn</language>
    <generator>www.qq.com</generator>
    <item>
      <title>外交部：呼吁半岛有关方抓住积极动向</title>
      <link>http://news.qq.com/a/20180105/024392.htm</link>
      <author>www.qq.com</author>
      <category/>
      <pubDate>2018-01-05 16:50:00</pubDate>
      <comments/>
      <description>据报道，5日，韩国统一部发言人称，朝鲜当天表示，同意接受韩方此前提议，于9日在板门店举行朝韩高级别会谈。中国外交部发言人耿爽在今天(5日)例行记者会上表示，呼吁各方发挥应有作用，承担应有责任，抓住半岛局势中的积极动向。外交部发言人耿爽：长期以来，中方为解决半岛问题作出了不懈努力，自始至终发挥着积极和建设</description>
    </item>
  </channel>
</rss>
```

### xpath
```xpath
/child::lectures/child::lecture[@number='0']
```