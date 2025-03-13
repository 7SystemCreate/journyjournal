<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Http\Requests\CreatePost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InnPostController extends Controller
{
    public function mypostDetail(Post $post) {

        return view('mypost_detail', [
            'post' => $post,
        ]);
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);

        // 削除フラグを更新
        $post->del_flg = 1;
        $post->save();

        return redirect()->route('inn.home')->with('status', '投稿を削除しました');
    }

    public function createPost() {

        return view('create_post');
    }

    public function editPost(Post $post) {

        return view('edit_post', [
            'post' => $post,
        ]);
    }

     public function createConf(CreatePost $request)
    {
        $post = new Post;
        
        $post->title = $request->title;
        $post->image = $request->file('image')->store('images/postimages', 'public');
        $post->date = $request->date;
        $post->max_people = $request->max_people;
        $post->amount = $request->amount;
        $post->comment = $request->comment;

        return view('create_post_conf', [
            'post' => $post,
        ]);
    }

    public function createComp(Request $request)
    {
        $post = new Post;
        $columns = ['title', 'image', 'date', 'max_people', 'amount', 'comment'];
        foreach($columns as $column) {
            $post->$column = $request->$column;
        }

        Auth::user()->post()->save($post);

        return view('create_post_comp');

    }

    public function editConf(Post $post, CreatePost $request)
    {
        $post->title = $request->title;
        $post->date = $request->date;
        $post->max_people = $request->max_people;
        $post->amount = $request->amount;
        $post->comment = $request->comment;

        if ($request->hasFile('image')) {
            // 古い画像が存在していたら削除
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }
            // 新しい画像を保存
            $post->image = $request->file('image')->store('images/postimages', 'public');
        }

        // チェックボックスがオンの場合、画像を削除
        if ($request->has('delete_image') && $request->delete_image == 1) {
            $post->image = null;
        }

        return view('edit_post_conf', [
            'post' => $post,
        ]);
    }

    public function update(Request $request, $id)
{
    // 投稿を取得
    $post = Post::findOrFail($id);

    // リクエストからのデータで投稿を更新
    $post->title = $request->title;
    $post->image = $request->image;
    $post->date = $request->date;
    $post->max_people = $request->max_people;
    $post->amount = $request->amount;
    $post->comment = $request->comment;

    // 投稿を保存
    $post->save();

    // 更新後のページへリダイレクト
    return redirect()->route('mypost.detail', ['post' => $post->id])->with('success', '投稿が更新されました');
}

}
