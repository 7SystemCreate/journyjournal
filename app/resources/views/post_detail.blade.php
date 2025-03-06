@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="card p-4">
        <!-- タイトル -->
        <h2 class="mb-3">{{ $post->title }}</h2>

        <div class="row">
            <!-- 左側: 画像 -->
            <div class="col-md-6">
                <img src="{{ asset('storage/' . ($post->image ?? 'images\postimages\defaultimage.png')) }}" class="img-fluid rounded" alt="投稿画像">
            </div>

            <!-- 右側: 投稿情報 -->
            <div class="col-md-6">
                <p><strong>予約可能日:</strong> {{ $post->date ?? '未定' }}</p>
                <p><strong>予約可能人数:</strong> {{ $post->max_people ?? '未定' }}</p>
                <p><strong>金額:</strong> {{ number_format($post->amount) }} 円</p>

                <!-- 投稿者情報 -->
                <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/' . ($post->user->icon ?? 'images/icon/defaulticon.png')) }}" 
                         class="rounded-circle me-2" width="50" height="50" alt="ユーザーアイコン">
                    <p class="mb-0">{{ $post->user->name ?? '投稿者不明' }}</p>
                </div>

                <!-- ボタン -->
                <div class="mt-3 d-flex justify-content-between">
                    <!-- いいねボタン -->
                    <form action="" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary">いいね！</button>
                    </form>
                     <!-- 通報ボタン -->
                    <a href={{ route('post.report', ['post' => $post['id']]) }} class="btn btn-warning">通報<a>
                    <!-- 予約ボタン -->
                    <a href={{ route('booking', ['post' => $post['id']]) }} class="btn btn-success">予約する</a>
                </div>
            </div>
        </div>
    </div>

    <!-- コメント (投稿の説明文) を予約ボタンの下に配置 -->
    <div class="card mt-4 p-4">
        <h4>詳細</h4>
        <p>{{ $post->comment }}</p>
    </div>
</div>
@endsection
