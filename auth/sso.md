# sso
```
foo:app server1  bar:app server2  sso: sso login server

//登入
ua request foo

foo check no foo session
foo redirect to sso with [redirect=foo]

ua request sso with [redirect=foo]
sso check no sso session
sso redirect to sso login page with [redirect=foo]

ua request sso login page
ua login with [ /username/password]

sso set sso session
sso redirect to foo with [sso session]

ua request foo with [sso session]

foo request sso with [sso session] get userinfo
sso save userinfo--foo to a map

foo set foo session
ua login to foo

ua request bar

bar check no bar session
bar redirect to sso with [redirect=bar]

ua request sso with [redirect=bar]
sso check has sso session
sso redirect to bar with [sso session]

ua request bar with [sso session]

bar request sso with [sso session] get userinfo
sso save userinfo--bar to a map
bar set bar session
ua login to bar

//登出
ua logout from foo
foo clear foo session
foo request sso clear sso session
sso clear sso session
sso get all app server from map
sso request all all app server clear all session
ua logout from all server

```
## cas
sso redirect时不使用sso session,而使用一次性ticket
app向sso验证ticket时，ticket立即失效并返回验证结果,若通过则同时返回用户信息
