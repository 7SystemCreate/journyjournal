<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // likesテーブルのデフォルト設定を使用
    protected $table = 'likes';


    protected $fillable = [ 'user_id','post_id' ];

    // リレーション: 1つのLikeは1つのPostに関連する
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // リレーション: 1つのLikeは1人のUserに関連する
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
