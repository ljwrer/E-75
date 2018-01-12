# oAuth

App授权
```
向auth提交[host/redirect_uri/description]得到[client_id/client_secret]
```


第一次授权

```
ua:browser app:app server  auth: auth and resource server

ua request app for resource in auth

app redirect to auth with [redirect_uri/client_id/state/scope]
ua request to auth with [redirect_uri/client_id/state/scope]
ua request auth with username and password

auth redirect to authorization page
ua request to authorization page
ua authorization
auth generator code and store user--client_id
auth redirect to app with  [code/state](此请求可能被csrf攻击)

ua request to app with  [code/state]
app request to auth with [code/state/client_id/client_secret(pre apply for)] over https and post
app get [access_token/token_type/expires_in/refresh_token/scope] from auth
auth expire code

//app可以利用access_token拿到用户在auth的username
//将auth的username将和ua在app的username绑定实现第三方登陆
//下一次当用户点击登陆可跳转到auth后凭借access_token获取auth的username比对然后登陆
//但code被截获后,可能通过csrf攻击绑定到别的用户:攻击者利用自己的账户获取code验证获取自己的access_token和username，被绑定到被攻击者username
//如果设置了state 因为攻击者无法伪造state 无法获取access_token所以可以规避这个问题


app request resource with [access_token]
//如果access_token失效，则利用refresh_token获取access_token
app send resource to ua

```
后面的授权
```
ua request app for resource in auth

app redirect to auth with [redirect_uri/client_id/state/scope]
ua request to auth with [redirect_uri/client_id/state/scope]
ua request auth with username and password

auth check user and find client_id // 用户不用再次授权
auth generator code
auth redirect to app with  [code/state]

ua request to app with  [code/state]
app request to auth with [code/state/client_id/client_secret(pre apply for)] over https
app get [access_token/token_type/expires_in/refresh_token/scope] from auth
auth expire code

app request resource with [access_token]
app send resource to ua
```

## Links
<https://zhuanlan.zhihu.com/p/20913727>  
<http://www.ruanyifeng.com/blog/2014/05/oauth_2_0.html>  
<https://www.jianshu.com/p/c7c8f51713b6>  


