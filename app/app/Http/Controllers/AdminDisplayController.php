<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminDisplayController extends Controller
{
    public function showMypage() {
        $user = Auth::user();
        
        return view('admin_mypage', compact('user'));
    }

    public function postList() {
        $posts = new Post;
        $postAll = $posts::where('del_flg', 0)
            ->withCount('reports')  // 通報件数を一緒に取得
            ->orderByDesc('reports_count')  // 通報件数の降順で並べるget();
            ->get();

        return view('post_list', [
            'posts' => $postAll,
        ]);
    }

    public function postDetail(Post $post) {

        return view('delete_post', [
            'post' => $post,
        ]);
    }
    public function postDelete(Post $post)
    {
        $post->del_flg = 1;
        $post->save();

        return redirect()->route('post.list')->with('status', '投稿を削除しました');
    }

    public function userList() {

        $userAll = User::where('role', '!=', '2')->where('del_flg', 0)->get(); // 管理者以外のユーザーを取得

        return view('user_list', [
            'users' => $userAll,
        ]);
    }
    public function userDetail(User $user) {

        return view('delete_user', [
            'user' => $user,
        ]);
    }
    public function userDelete(User $user)
    {
        $user->del_flg = 1;
        $user->save();

        Post::where('user_id', $user->id)->update(['del_flg' => 1]);

        return redirect()->route('user.list')->with('status', '投稿を削除しました');
    }
}
