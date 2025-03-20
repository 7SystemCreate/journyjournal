<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Post $post)
    {
        if (!Like::where('post_id', $post->id)->where('user_id', Auth::id())->exists()) {
            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id
            ]);
        }

        $likeCount = Like::where('post_id', $post->id)->count();

        return response()->json([
            'success' => true,
            'message' => 'いいねしました。',
            'like_count' => $likeCount
        ]);
    }

    public function unlike(Post $post)
    {
        $like = Like::where('post_id', $post->id)->where('user_id', Auth::id())->first();
        if ($like) {
            $like->delete();
        }

        $likeCount = Like::where('post_id', $post->id)->count();

        return response()->json([
            'success' => true,
            'message' => 'いいねを取り消しました。',
            'like_count' => $likeCount
        ]);
    }
}
