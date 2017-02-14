<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Facades\Session;

class UserController extends Controller
{
    public function login(Request $request)
    {
        // 若用户已经登陆则直接返回用户登录凭证
        if (Session::$segment->get('user.login', false)) {
            return $this->profile();
        }

        // 如果所需字段不全返回 400 Bad Request
        if (!$request->has(['login_name', 'password'])) {
            return response()->json(['status' => 'error', 'message' => 'Bad Request!'], 400);
        }

        try {
            $user = User::where('login_name', $request->input('login_name'))->firstOrFail();
        } catch (ModelNotFoundException $e) {
            // 没有找到用户也返回 401
            return response()->json(['status' => 'error', 'message' => 'Unauthorized!'], 401);
        }

        if (!password_verify($request->get('password'), $user->password)) {
            // 密码不符返回 401
            return response()->json(['status' => 'error', 'message' => 'Unauthorized!'], 401);
        }

        // 登陆成功
        $data = $user->toArray();
        if (!$user->logined) {
            $user->logined = true;
            $user->save();
        }
        Session::$segment->set('user.login', true);
        Session::$segment->set('user.model', $user);
        return response()->json($data);
    }

    public function logout()
    {
        Session::$segment->set('user.login', null);
        Session::$segment->set('user.model', null);
        return response()->json(['status' => 'success', 'message' => 'done!']);
    }

    public function create(Request $request)
    {
        // 用户已登陆的情况
        if (Session::$segment->get('user.login', false)) {
            return response()->json(['status' => 'warning', 'message' => '当前状态您无法创建用户！'], 403);
        }

        // 验证输入是否含必需字段且能通过验证
        // 暂时没有使用 Validator
        if (!$request->has(['name', 'login_name', 'password']) or !User::validate($request->input())) {
            return response()->json(['status' => 'error', 'message' => 'Bad Request!'], 400);
        }

        $user = new User;
        $user->fill($request->input());
        $user->password = password_hash($request->input('password'), PASSWORD_DEFAULT);
        $user->type = User::TYPE_STUDENT;
        $user->logined = false;
        $user->save();

        Session::$segment->set('user.login', true);
        Session::$segment->set('user.model', $user);

        return $user;
    }

    public function profile()
    {
        return Auth::user();
    }

    public function info($login_name)
    {
        $user = User::where('login_name', $login_name)->firstOrFail();
        $user = $user->toArray();
        foreach (User::PRIVATE_COLUMN as $key) {
            unset($user[$key]);
        }
        return response()->json($user);
    }
}
