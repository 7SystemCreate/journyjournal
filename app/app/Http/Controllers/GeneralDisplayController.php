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

    public function showMylike()
    {
        // ログインしているユーザーが「いいね」をした投稿を取得
        $posts = Post::whereHas('likes', function($query) {
            $query->where('user_id', auth()->id());
        })->get();

        return view('like_list', compact('posts'));
    }

    public function showDetail(Booking $booking)
    {
        $post = $booking->post;
        return view('mybooking_conf', compact('booking', 'post'));
    }

    public function deleteBooking(Booking $booking)
    {
        $booking->del_flg = 1;
        $booking->save();

        return redirect()->route('general.mypage')->with('success', '予約を削除しました。');
    }


}
