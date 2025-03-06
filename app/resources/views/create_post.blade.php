@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="card p-4">
        <h2 class="mb-3">新規投稿</h2>

        <form action="{{ route('createpost.conf') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST') 

            <!-- タイトル -->
            <div class="mb-3">
                <label for="title" class="form-label">タイトル <span class="text-danger">*</span></label>
                <input type="text" id="title" name="title" class="form-control" value="" required>
            </div>

            <!-- 画像アップロード（任意のためアスタリスクなし） -->
            <div class="mb-3">
                <label for="image" class="form-label">画像</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>

            <!-- 予約可能日 -->
            <div class="mb-3">
                <label for="date" class="form-label">予約可能日 <span class="text-danger">*</span></label>
                <input type="date" id="date" name="date" class="form-control" value="" required>
            </div>

            <!-- 予約可能人数 -->
            <div class="mb-3">
                <label for="max_people" class="form-label">予約可能人数 <span class="text-danger">*</span></label>
                <input type="number" id="max_people" name="max_people" class="form-control" value="" min="1" required>
            </div>

            <!-- 金額 -->
            <div class="mb-3">
                <label for="amount" class="form-label">金額 (円) <span class="text-danger">*</span></label>
                <input type="number" id="amount" name="amount" class="form-control" value="" min="0" required>
            </div>

            <!-- 内容 -->
            <div class="mb-3">
                <label for="comment" class="form-label">内容 <span class="text-danger">*</span></label>
                <textarea id="comment" name="comment" class="form-control" rows="4" required></textarea>
            </div>

            <!-- ボタン -->
            <div class="mt-3 d-flex justify-content-between">
                <a href="{{ route('inn.home') }}" class="btn btn-secondary">戻る</a>
                <button type="submit" class="btn btn-primary">投稿内容確認</button>
            </div>
        </form>
    </div>
</div>
@endsection
