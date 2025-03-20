<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Post extends Model
{
    protected $fillable = [
        'id','title','date','max_people','comment','image','amount'
    ];

    public function user() {
        return $this->BelongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likeCount()
    {
        return $this->likes()->count();
    }

    public function isLikedByUser($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function getReportCountAttribute()
    {
        return $this->reports()->count();
    }
}
