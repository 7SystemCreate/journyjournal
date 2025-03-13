<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Booking;
use App\Http\Requests\CreateBooking;
use Illuminate\Support\Facades\Auth;


class GeneralBookingController extends Controller
{
   public function booking(Post $post) {

        return view('booking', [
            'post' => $post,
        ]);
    }

    public function bookingConf(CreateBooking $request, Post $post){

        $postId = $request->input('post_id');
        $post = Post::find($postId);

        $booking = new Booking;

        $booking->name = $request->name;
        $booking->checkin_date = $request->checkin_date;
        $booking->checkout_date = $request->checkout_date;
        $booking->booking_people = $request->booking_people;
        $booking->tel = $request->tel;

        return view('booking_conf', [
            'post' => $post,
            'booking' => $booking,
        ]);
    }

    public function bookingComp(Request $request){

        $booking = new Booking;
        /*
        $booking->name = $request->name;
        $booking->checkin_date = $request->checkin_date;
        $booking->checkout_date = $request->checkout_date;
        $booking->booking_people = $request->booking_people;
        $booking->tel = $request->tel;
        $booking->post_id = $request->post_id;
        $booking->save();
        */
        $columns = ['name', 'checkin_date', 'checkout_date', 'booking_people', 'tel', 'post_id'];
        foreach($columns as $column) {
            $booking->$column = $request->$column;
        }

        Auth::user()->booking()->save($booking);


        return view('booking_comp');
    }
}
