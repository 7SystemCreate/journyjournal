<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class GeneralPostController extends Controller
{
    public function postDetail(Post $post) {

        return view('post_detail', [
            'post' => $post,
        ]);
    }

    

}
