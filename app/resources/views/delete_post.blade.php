@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="card p-4">
        <!-- タイトル -->
        <h2 class="mb-3">{{ $post->title }}</h2>

        <div class="row">
            <!-- 左側: 画像 -->
            <div class="col-md-6">
                <img src="{{ asset('storage/' . ($post->image ?? 'images/postimages/defaultimage.png')) }}" class="img-fluid rounded" alt="投稿画像">
            </div>

            <!-- 右側: 投稿情報 -->
            <div class="col-md-6">
                <p><strong>予約可能日:</strong> {{ $post->date ?? '未定' }}</p>
                <p><strong>予約可能人数:</strong> {{ $post->max_people ?? '未定' }}</p>
                <p><strong>金額:</strong> {{ number_format($post->amount) }} 円</p>
                <p class="text-danger mb-0">通報件数: {{ $post->report_flg }}</p>
            </div>
        </div>
    </div>

    <!-- コメント (投稿の説明文) を予約ボタンの下に配置 -->
    <div class="card mt-4 p-4">
        <h4>詳細</h4>
        <p>{{ $post->comment }}</p>
    </div>

    <!-- ボタン -->
    <div class="mt-3 d-flex justify-content-center">
        <!-- 削除ボタン（formでPOSTリクエストを送る） -->
        <form action="{{ route('post.delete', $post->id) }}" method="POST" class="delete-form">
            @csrf
            @method('POST')
            <button type="submit" class="btn btn-danger">投稿を削除</button>
        </form>
    </div>
</div>

<!-- 削除確認用JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteForms = document.querySelectorAll(".delete-form");
        deleteForms.forEach(form => {
            form.addEventListener("submit", function (event) {
                if (!confirm("この投稿を削除してもよろしいですか？")) {
                    event.preventDefault(); // キャンセルされた場合、削除処理を中止
                }
            });
        });
    });
</script>

@endsection
