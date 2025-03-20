<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        $role = Auth::user()->role;

        if ($role == 2) {
            return route('admin.mypage'); // 管理者画面
        } elseif ($role == 1) {
            return route('inn.home');   // 旅館運営ユーザー
        }

        return route('home');  // 一般ユーザー
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();

        if ($user && $user->del_flg == 1) {
            return false;
        }

        return Auth::attempt($credentials, $request->filled('remember'));
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && $user->del_flg == 1) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'メールアドレスまたはパスワードが正しくありません。', //本当は削除済み
            ]);
        }

        throw \Illuminate\Validation\ValidationException::withMessages([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ]);
    }
}
