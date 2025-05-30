@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="row align-items-center mb-3">
       <div class="col-md-6 d-flex align-items-center justify-content-start mt-4">
            <img src="{{ asset('storage/' . $user->icon) }}" 
                 class="rounded-circle" 
                 style="width: 80px; height: 80px; object-fit: cover;" 
                 alt="ユーザーアイコン">
            <h5 class="ml-3">{{ $user->name }}</h5>
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route('account.edit') }}" class="btn btn-outline-secondary">アカウント情報編集</a>
        </div>
    </div>

    <div class="row justify-content-center mt-5 px-7">
        <div class="col-md-6 d-flex justify-content-between">
            <a href="{{ route('general.mybooking') }}" class="btn btn-primary btn-lg py-3 px-4">予約一覧</a>
            <a href="{{ route('general.likelist') }}" class="btn btn-secondary btn-lg py-3 px-4">いいね一覧</a>
        </div>
    </div>
</div>
@endsection

