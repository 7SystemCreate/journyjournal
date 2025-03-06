<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
     protected $fillable = ['name', 'checkin_date', 'checkout_date', 'booking_people', 'tel', 'post_id'];

     public function post() {
         return $this->belongsTo('App\Post', 'post_id', 'id');
     }
}
