<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function edit()
    {
        return view('account_edit');
    }

    public function editConfirm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'icon' => 'nullable|image|max:2048'
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // アイコンがアップロードされた場合、一時保存
        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('images/iconimages', 'public');
            $userData['icon'] = $path;
        }

        return view('account_edit_conf', compact('userData'));
    }

        public function updateAccount(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->has('icon')) {
            $user->icon = $request->icon;
        }

        $user->save();

        return redirect()->route('account.edit')->with('status', 'アカウント情報を更新しました！');
    }

    public function deleteAccountConf()
    {
        return view('delete_account');
    }

    public function accountDelete(User $user)
    {
        $user->del_flg = 1;
        $user->save();

        Post::where('user_id', $user->id)->update(['del_flg' => 1]);
        Auth::logout();
        return redirect()->route('home')->with('status', '投稿を削除しました');
    }
}
