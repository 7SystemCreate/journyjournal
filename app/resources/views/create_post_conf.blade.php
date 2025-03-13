@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="card p-4">
        <h2 class="mb-3">投稿内容確認</h2>

        <form id="postForm" action="{{ route('createpost.comp') }}" method="POST">
            @csrf
            @method('POST')

            <div class="mb-3">
                <label class="form-label">タイトル</label>
                <p class="form-control-static">{{ $post->title }}</p>
                <input type="hidden" name="title" value="{{ $post->title }}">
            </div>

            <div class="mb-3">
                <label class="form-label">画像</label>
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . ($post->image ?? 'images\postimages\defaultimage.png')) }}" class="img-fluid rounded" width="200">
                    </div>
                    <input type="hidden" name="image" value="{{ $post->image }}">
            </div>

            <div class="mb-3">
                <label class="form-label">予約可能日</label>
                <p class="form-control-static">{{ $post->date }}</p>
                <input type="hidden" name="date" value="{{ $post->date }}">
            </div>

            <div class="mb-3">
                <label class="form-label">予約可能人数</label>
                <p class="form-control-static">{{ $post->max_people }}</p>
                <input type="hidden" name="max_people" value="{{ $post->max_people }}">
            </div>

            <div class="mb-3">
                <label class="form-label">金額 (円)</label>
                <p class="form-control-static">{{ $post->amount }} 円</p>
                <input type="hidden" name="amount" value="{{ $post->amount }}">
            </div>

            <div class="mb-3">
                <label class="form-label">内容</label>
                <p class="form-control-static">{{ $post->comment }}</p>
                <input type="hidden" name="comment" value="{{ $post->comment }}">
            </div>

            <div class="mt-3 d-flex justify-content-between">
                <a href="{{ route('create.post') }}" class="btn btn-secondary">戻る</a>
                <button type="submit" class="btn btn-primary">投稿する</button>
            </div>
        </form>
    </div>
</div>

@endsection
