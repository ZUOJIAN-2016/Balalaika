# user system
### Create a user
 创建一个新用户，且使用该用户凭证登陆。  
 如果用户已经登陆,则返回错误信息.
 Request:
```
POST /users
Content-Type: application/json

{
    "name": "xxx",          // 姓名
    "login_name": "xxx",    // 登陆所用名
    "password": "xxx",      // 密码
    "mac_addr": "xxx",      // 用户绑定的 mac 地址（可选）
    "key": "xxx"            // 用户在注册时提供的 key（可选），作用待定
}
```

|key|value|
|-|-|
|key|保密密钥，根据其不同内部商定对请求的响应|
|name|姓名|
|login_name|登陆所用名|
|password|密码|
|mac_addr(optional)|用户绑定的 mac 地址（可选）|

Response:
```
Content-Type: application/json

{
    "id": 1,
    "name": "{real_name}",
    "login_name": "{login_name}",
    "type": 0,
    "logined": 0
}

400 Bad Request
Content-Type: application/json
{
    "status": "warning",
    "message": "您已经登陆了！",
    "action": "abort"
}
```

---
### Get user info
取得指定用户 id 的基本信息
Request:
```
GET /users/{user_id}
```

Response:
```
Content-Type: application/json

{
    id: 1,
    name: "{real_name}",
    type: 0,
}
```

---
### Get current user
取得当前登陆用户的信息
Request:
```
GET /current/user
```

Response:
```
Content-Type: application/json

{
    id: 1,
    name: "{real_name}",
    login_name: "{login_name}",
    type: 0,
    logined: 0
}
```

---
### Type 说明
|value|description|
|-|-|
|0|学生|
|...|...|
