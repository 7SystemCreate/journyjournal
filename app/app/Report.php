<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
     protected $fillable = ['report_reason'];

     public function post() {
         return $this->belongsTo('App\Post', 'post_id', 'id');
     }
}
