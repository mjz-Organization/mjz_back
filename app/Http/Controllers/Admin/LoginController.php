<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * 登录使用的账号字段名
     * @return string
     */
    public function username()
    {
        return 'user';
    }

    /**
     * 认证服务方（登录时需要使用SessionGuard，访问api时使用TokenGuard）
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('adminLogin');
    }

    public function login(LoginRequest $request)
    {
        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();

            $user->generateToken();

            $this->loginSuccess($user);

            return responseToJson(0,'登录成功',$user->toArray());
        }

        return responseToJson(2,'登录失败');
    }

    public function logout()
    {
        $user = Auth::guard('admin')->user();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return responseToJson(0,'退出成功');
    }

    // 登陆成功之后调用
    private function loginSuccess($user)
    {
        session(['user'=> $user]);
    }
}