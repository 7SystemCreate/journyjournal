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
}
