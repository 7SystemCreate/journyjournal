@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="row align-items-center mb-3 px-7">
        <div class="col-md-6 d-flex align-items-center justify-content-start mt-4">
            <img src="{{ asset('storage/' . $user->icon) }}" 
                 class="rounded-circle" 
                 style="width: 80px; height: 80px; object-fit: cover;" 
                 alt="ユーザーアイコン">
            <h5 class="ml-3">{{ $user->name }}</h5>
        </div>
    </div>

    <div class="row justify-content-center mt-5 px-7">
        <div class="col-md-6 d-flex justify-content-between">
            <a href="{{ route('post.list') }}" class="btn btn-primary btn-lg py-3 px-4">投稿一覧</a>
            <a href="{{ route('user.list') }}" class="btn btn-secondary btn-lg py-3 px-4">ユーザ一覧</a>
        </div>
    </div>
</div>
@endsection
