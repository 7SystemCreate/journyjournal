@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="card p-4">
        <h2 class="mb-3">投稿内容を編集</h2>
        <div class= 'panel-body'>
            @if($errors->any())
            <div class='alert alert-danger'>
                <ul>
                    @foreach($errors->all() as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <form action="{{ route('editpost.conf', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST') 

            <!-- タイトル -->
            <div class="mb-3">
                <label for="title" class="form-label">タイトル</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
            </div>

            <!-- 画像アップロード -->
            <div class="mb-3">
                <label for="image" class="form-label">画像</label>
                <input type="file" id="image" name="image" class="form-control">
                @if ($post->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded" width="200">
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="delete_image" id="delete_image" value="1">
                        <label class="form-check-label" for="delete_image">画像を削除</label>
                    </div>
                @endif
            </div>

            <!-- 予約可能日 -->
            <div class="mb-3">
                <label for="date" class="form-label">予約可能日</label>
                <input type="date" id="date" name="date" class="form-control" value="{{ old('date', $post->date) }}">
            </div>

            <!-- 予約可能人数 -->
            <div class="mb-3">
                <label for="max_people" class="form-label">予約可能人数</label>
                <input type="number" id="max_people" name="max_people" class="form-control" value="{{ old('max_people', $post->max_people) }}" min="1">
            </div>

            <!-- 金額 -->
            <div class="mb-3">
                <label for="amount" class="form-label">金額 (円)</label>
                <input type="number" id="amount" name="amount" class="form-control" value="{{ old('amount', $post->amount) }}" min="0">
            </div>

            <!-- 内容 -->
            <div class="mb-3">
                <label for="comment" class="form-label">内容</label>
                <textarea id="comment" name="comment" class="form-control" rows="4">{{ old('comment', $post->comment) }}</textarea>
            </div>

            <!-- ボタン -->
            <div class="mt-3 d-flex justify-content-between">
                <a href="{{ route('mypost.detail', ['post' => $post->id]) }}" class="btn btn-secondary">戻る</a>
                <button type="submit" class="btn btn-primary">編集内容確認</button>
            </div>
        </form>
    </div>
</div>
@endsection
