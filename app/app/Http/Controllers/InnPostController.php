<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

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

     public function createConf(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'date' => 'nullable|date',
            'max_people' => 'nullable|integer|min:1',
            'amount' => 'nullable|integer|min:0',
            'comment' => 'nullable|string',
        ]);

        // 画像がアップロードされた場合
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/postimages', 'public');
            $validated['image'] = $imagePath;
        }

        session(['post_data' => $validated]);

        return view('create_post_conf');
    }

    public function createComp(Request $request)
    {
        $data = session('post_data');

        if (!$data) {
            return redirect()->route('create.post')->with('error', 'セッションが切れました。もう一度入力してください。');
        }

        $post = Post::create($data);

        session()->forget('post_data');

       return view('create_post_comp');

    }

    public function editConf(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'date' => 'nullable|date',
            'max_people' => 'nullable|integer|min:1',
            'amount' => 'nullable|integer|min:0',
            'comment' => 'nullable|string',
        ]);

        // 画像削除チェックボックスがONならフラグをセット
        if ($request->has('delete_image')) {
            $validated['delete_image'] = true;
        }
        // 画像がアップロードされた場合
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/postimages', 'public');
            $validated['image'] = $imagePath;
        }

        session(['post_data' => $validated]);

        return view('edit_post_conf', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update(session('post_data'));

        if (!empty($data['delete_image'])) {
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }
            $data['image'] = null;
        }

        if (!isset($data['image'])) {
            unset($data['image']);
        }

        session()->forget('post_data');

        return redirect()->route('mypost.detail', ['post' => $post->id])->with('success', '投稿が更新されました');
    }
}
