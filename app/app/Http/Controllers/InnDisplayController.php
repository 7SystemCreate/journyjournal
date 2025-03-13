<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Illuminate\Support\Facades\Auth;

class InnDisplayController extends Controller
{
    public function index(){
        //Eloquent
        //モデルのインスタンスを生成し、変数spendingに代入
        //spendingsモデルから取得 配列化
        $postAll = Auth::user()->post()->where('del_flg', 0)->get();
        
        return view('inn_main', [
            'posts' => $postAll,
        ]);
    }

    public function showMypage() {
        $user = Auth::user();
        
        return view('inn.mypage', compact('user'));
    }
}
