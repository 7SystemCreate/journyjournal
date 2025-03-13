<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AdminDisplayController extends Controller
{
    public function showMypage() {
        $user = Auth::user();
        
        return view('admin_mypage', compact('user'));
    }
}
