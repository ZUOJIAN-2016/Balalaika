<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function create(Request $request)
    {
        if (!Session::$segment->get('user.login', false))
        {
            return response()->json(['status' => 'warning', 'message' => '您已经登陆了！', 'action' => 'abort'], 400);
        }

        // 验证输入是否含必需字段且能通过验证
        // 暂时没有使用 Validator
        if (!$request->has(['name', 'login_name', 'password']) or !User::validate($request->input()))
        {
            return response()->json(['status' => 'error', 'message' => 'Bad Request!', 'action' => 'abort'], 400);
        }
        $user = new User;
        $user->fill($request->input());
        $user->password = password_hash($request->input('password'), PASSWORD_DEFAULT);
        $user->type = User::TYPE_STUDENT;
        $user->logined = false;
        $user->save();

        Session::$segment->set('user.login', true);
        Session::$segment->set('user', $user);

        $this->profile();
    }

    public function profile()
    {
        return Auth::user();
    }

    public function info($id)
    {
        $user = User::findOrFail($id);
        $user = $user->toArray();
        foreach (User::privateData() as $key) {
            unset($user[$key]);
        }
        return response()->json($user);
    }
}
