<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Like;
use App\Booking;
use Illuminate\Support\Facades\Auth;


class GeneralDisplayController extends Controller
{
    public function index(){
        //Eloquent
        $posts = new Post;
        $postAll = $posts::where('del_flg', 0)->get();
        
        return view('general_main', [
            'posts' => $postAll,
        ]);
    }

    public function showMypage() {
        $user = Auth::user();
        
        return view('general_mypage', compact('user'));
    }

    public function showMybooking() {
    
        $bookings = Booking::where('user_id', Auth::id())->where('del_flg', 0)->with('post') ->latest() ->get();
        return view('mybooking_list', compact('bookings'));
    }

    public function showMylike() {
        $posts = Post::whereHas('likes', function($query) {
            $query->where('user_id', auth()->id());
        })->get();

        return view('like_list', compact('posts'));
    }

    public function showDetail(Booking $booking) {
        $post = $booking->post;
        return view('mybooking_conf', compact('booking', 'post'));
    }

    public function deleteBooking(Booking $booking) {
        $booking->del_flg = 1;
        $booking->save();

        return redirect()->route('general.mypage')->with('success', '予約を削除しました。');
    }

    public function search(Request $request) {
        $search = $request->input('search'); 
        $start_date = $request->input('start_date'); 
        $end_date = $request->input('end_date'); 
        $price_range = $request->input('price_range'); 

        $query = Post::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('comment', 'like', '%' . $search . '%');
            });
        }

        if ($start_date) {
            $query->whereDate('date', '>=', $start_date);
        }
        if ($end_date) {
            $query->whereDate('date', '<=', $end_date);
        }

        if ($price_range) {
            switch ($price_range) {
                case '1':
                    $query->where('amount', '<=', 5000);
                    break;
                case '2':
                    $query->whereBetween('amount', [5000, 10000]);
                    break;
                case '3':
                    $query->whereBetween('amount', [10000, 20000]);
                    break;
                case '4':
                    $query->where('amount', '>=', 20000);
                    break;
            }
        }

        $posts = $query->get() ?? [];

        return view('general_main', [
            'posts' => $posts,
            'search' => $search,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'price_range' => $price_range,
        ]);
    }
}
