<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table = 'users';

    protected $fillable = [
        'name', 'login_name', 'mac_addr'
    ];

    protected $hidden = [
        'password',
    ];

    static public function validate(array $attr)
    {
        // todo 验证输入是否合法
    }

    // 只有用户自己才能看到的信息以及具有极高权限管理员才能看到的信息字段
    static public function privateData()
    {
        return ['login_name', 'mac_addr'];
    }
    
    const TYPE_STUDENT = 0;
}
