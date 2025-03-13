<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Illuminate\Support\Facades\Auth;


class GeneralDisplayController extends Controller
{
    public function index(){
        //Eloquent
        $posts = new Post;
        $postAll = $posts::where('del_flg', 0)->get();
        
        return view('general_main', [
            'posts' => $postAll,
        ]);
    }

    public function showMypage() {
        $user = Auth::user();
        
        return view('general_mypage', compact('user'));
    }
}
