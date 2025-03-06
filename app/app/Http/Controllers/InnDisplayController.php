<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class InnDisplayController extends Controller
{
    public function index(){
        //Eloquent
        //モデルのインスタンスを生成し、変数spendingに代入
        $posts = new Post;
        //spendingsモデルから取得 配列化
        $postAll = $posts::where('del_flg', 0)->get();
        
        return view('inn_main', [
            'posts' => $postAll,
        ]);
    }
}
