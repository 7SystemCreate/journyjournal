@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="row align-items-center mb-3 px-7">
        <!-- 左上: ユーザーアイコンとユーザー名 -->
        <div class="col-md-6 d-flex align-items-center justify-content-start mt-4">
            <img src="{{ asset('storage/' . $user->icon) }}" 
                 class="rounded-circle" 
                 style="width: 80px; height: 80px;" 
                 alt="ユーザーアイコン">
            <h5 class="ml-3">{{ $user->name }}</h5>
        </div>

        <!-- 右上: アカウント情報編集ボタン -->
        <div class="col-md-6 text-right">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary py-2 px-4">アカウント情報編集</a>
        </div>
    </div>

    <!-- 画面中央: 予約一覧 & ユーザー一覧 -->
    <div class="row justify-content-center mt-5 px-7">
        <div class="col-md-6 d-flex justify-content-between">
            <a href="{{ route('home') }}" class="btn btn-primary btn-lg py-3 px-4">投稿一覧</a>
            <a href="{{ route('home') }}" class="btn btn-secondary btn-lg py-3 px-4">ユーザ一覧</a>
        </div>
    </div>
</div>
@endsection
