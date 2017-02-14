# 用户系统
### Type 说明
 用户类型对应的值：

| Type | Value |
| :---: | :---: |
| RootAdmin | -1 |
| Student | 0 |
 
### 未登陆时访问某些 url
```
HTTP/1.1 401 Unauthorized
Content-Type: application/json

{"status":"error","message":"Unauthorized!"}
```

## 相关 API 列表
### 登陆
 Request:
```
HTTP/1.1 POST /login
Content-Type: application/json

{
    "login_name": "{login_name}",
    "password": "{password}"
}
```

```
/** 用户名密码不符或用户不存在 **/
HTTP/1.1 401 Unauthorized
Content-Type: application/json

{"status":"error","message":"Unauthorized!"}


/** 缺少必须字段 **/
HTTP/1.1 400 Bad Request
Content-Type: application/json

{"status":"error","message":"Bad Request!"}


/** 登陆成功 **/
HTTP/1.1 200 OK
Content-Type: application/json

{
    name: "{real_name}",
    login_name: "{login_name}",
    type: 0,
    logined: 0
}
```

### 用户注册
 创建一个新用户，且使用该用户凭证登陆。  
 如果用户已经登陆,则返回错误信息.
 Request:
```
HTTP/1.1 POST /users
Content-Type: application/json

{
    "name": "xxx",          // 姓名
    "login_name": "xxx",    // 登陆所用名
    "password": "xxx",      // 密码
    "mac_addr": "xxx",      // 用户绑定的 mac 地址（可选）
    "key": "xxx"            // 用户在注册时提供的 key（可选），作用待定
}
```

Response:
```
HTTP/1.1 200 OK
Content-Type: application/json

{
    "name": "{real_name}",
    "login_name": "{login_name}",
    "type": 0,
    "logined": 0
}


/** 用户处于登陆状态或者无权创建用户 **/
HTTP/1.1 403 Forbidden
Content-Type: application/json
{
    "status": "warning",
    "message": "当前状态您无法创建用户！"
}
```

---
### 取得指定用户名的基本信息
Request:
```
GET /users/{login_name}
```

Response:
```
Content-Type: application/json

{
    name: "{real_name}",
    login_name: "{login_name}"
    type: 0,
}
```

---
### 取得当前登陆用户的信息
Request:
```
GET /current/user
```

Response:
```
Content-Type: application/json

{
    name: "{real_name}",
    login_name: "{login_name}",
    type: 0,
    logined: 0
}
```
