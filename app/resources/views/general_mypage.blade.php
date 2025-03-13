@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="row align-items-center mb-3">
        <div class="col-md-6 d-flex align-items-center">
            <img src="{{ asset('storage/' . $user->icon) }}" 
                 class="rounded-circle" 
                 style="width: 80px; height: 80px;" 
                 alt="ユーザーアイコン">
            <h5 class="ml-3">{{ $user->name }}</h5>
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">アカウント情報編集</a>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-6 text-center">
            <a href="{{ route('home') }}" class="btn btn-primary btn-lg">予約確認</a>
        </div>
    </div>
</div>
@endsection
