# user system
### Create a user
创建一个新用户，且使用该用户凭证登陆。
Request:
```
POST /users
```

|key|value|
|-|-|
|key|保密密钥，根据其不同内部商定对请求的响应|
|name|姓名|
|login_name|登陆所用名|
|password|密码|
|type|用户类型|
|mac_addr(optional)|用户绑定的 mac 地址（可选）|

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
