<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Booking;
use App\Http\Requests\CreateBooking;

class RegistrationController extends Controller
{
    public function booking(Post $post) {

        return view('booking', [
            'post' => $post,
        ]);
    }

    public function bookingConf(CreateBooking $request, Post $post)
    {
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

    public function bookingComp(CreateBooking $request, Post $post) {

        $booking = new Booking;

        $booking->name = $request->name;
        $booking->checkin_date = $request->checkin_date;
        $booking->checkout_date = $request->checkout_date;
        $booking->booking_people = $request->booking_people;
        $booking->tel = $request->tel;

        $booking->save();

        return redirect()->route('booking.comp');
    }

}
