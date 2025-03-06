@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">通報理由</h1>
    <form action="{{ route('report.conf', ['post' => $post->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="form-group">
            <textarea id="report_reason" name="report_reason" rows="5" class="form-control" placeholder="通報理由を入力" required></textarea>
        </div>
        <div class="form-group text-center mt-4">
            <a href="{{ route('post.detail', ['post' => $post->id]) }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary">確定</button>
        </div>
    </form>
</div>
@endsection
