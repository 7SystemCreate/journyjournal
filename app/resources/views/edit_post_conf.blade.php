@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="card p-4">
        <h2 class="mb-3">編集内容確認</h2>

        <form action="{{ route('post.update', ['post' => $post->id]) }}" method="POST">
            @csrf
            @method('POST')

            <!-- タイトル -->
            <div class="mb-3">
                <label class="form-label">タイトル</label>
                <p class="form-control-static">{{ session('post_data.title') }}</p>
                <input type="hidden" name="title" value="{{ session('post_data.title') }}">
            </div>

            <!-- 画像 -->
            <div class="mb-3">
                <label class="form-label">画像</label>
                @if (session('post_data.image'))
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . session('post_data.image')) }}" class="img-fluid rounded" width="200">
                    </div>
                    <input type="hidden" name="image" value="{{ session('post_data.image') }}">
                @endif
                <input type="hidden" name="image" value="{{ session('post_data.image') }}">
            </div>

            <!-- 予約可能日 -->
            <div class="mb-3">
                <label class="form-label">予約可能日</label>
                <p class="form-control-static">{{ session('post_data.date') }}</p>
                <input type="hidden" name="date" value="{{ session('post_data.date') }}">
            </div>

            <!-- 予約可能人数 -->
            <div class="mb-3">
                <label class="form-label">予約可能人数</label>
                <p class="form-control-static">{{ session('post_data.max_people') }}</p>
                <input type="hidden" name="max_people" value="{{ session('post_data.max_people') }}">
            </div>

            <!-- 金額 -->
            <div class="mb-3">
                <label class="form-label">金額 (円)</label>
                <p class="form-control-static">{{ number_format(session('post_data.amount')) }} 円</p>
                <input type="hidden" name="amount" value="{{ session('post_data.amount') }}">
            </div>

            <!-- 内容 -->
            <div class="mb-3">
                <label class="form-label">内容</label>
                <p class="form-control-static">{{ session('post_data.comment') }}</p>
                <input type="hidden" name="comment" value="{{ session('post_data.comment') }}">
            </div>

            <!-- ボタン -->
            <div class="mt-3 d-flex justify-content-between">
                <a href="{{ route('edit.post', ['post' => $post->id]) }}" class="btn btn-secondary">戻る</a>
                <button type="submit" class="btn btn-primary">更新する</button>
            </div>
        </form>
    </div>
</div>
@endsection
