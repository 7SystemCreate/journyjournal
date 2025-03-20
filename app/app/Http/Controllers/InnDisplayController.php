<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Booking;
use Illuminate\Support\Facades\Auth;

class InnDisplayController extends Controller
{
    public function index(){
        //Eloquent
        //モデルのインスタンスを生成し、変数spendingに代入
        //spendingsモデルから取得 配列化
        $postAll = Auth::user()->post()->where('del_flg', 0)->get();
        
        return view('inn_main', [
            'posts' => $postAll,
        ]);
    }

    public function showMypage() {
        $user = Auth::user();
        
        return view('inn_mypage', compact('user'));
    }

    public function showBooking() {
        $user = Auth::user();

        $bookings = Booking::whereHas('post', function ($query) use ($user) {
            $query->where('user_id', $user->id); // ユーザーIDが投稿者の投稿のみ
        })
        ->with(['post', 'user'])  // 予約に関連する投稿情報とユーザー情報を取得
        ->get();

        return view('innbooking_list', compact('bookings'));
    }

    public function showDetail(Booking $booking)
    {
        $post = $booking->post;
        return view('innbooking_detail', compact('booking', 'post'));
    }
}
