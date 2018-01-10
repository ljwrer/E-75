# ajax
### 浏览器解释html
HTML页面以DOM形式创建于内存(树)

ajax代指浏览器客户端动态修改html的技术

 - onreadystatechange
 - readyState
    - 0 (unitialized)
    - 1 (open)
    - 2 (sent)
    - 3 (receiving)
    - 4 (loaded)
 - responseBody(IE)
 - responseText
 - responseXML
 - status
    - 200
    - 404
    - 500
 - statusText

###  中间服务器
同源策略 document.domain
csrf:
    中间人拦截,xss注入->插入恶意标签->得到sessionID->伪造请求

别处的数据都是不可信的,尤其是非https请求
使用中间服务器过滤数据

#### php#sleep
wait seconds

### php#json_encode
对象序列化为json,

```php
<?php
header("Content-type:application/json");
print json_encode($data);
?>
```

>Mashup应用