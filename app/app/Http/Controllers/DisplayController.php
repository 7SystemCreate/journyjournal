<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class DisplayController extends Controller
{
    public function index(){
        //Eloquent
        //モデルのインスタンスを生成し、変数spendingに代入
        $posts = new Post;
        //spendingsモデルから取得 配列化
        $postAll = $posts::where('del_flg', 0)->get();
        
        return view('general_main', [
            'posts' => $postAll,
        ]);
    }

    public function postDetail(Post $post) {

        return view('post_detail', [
            'post' => $post,
        ]);
    }
}
