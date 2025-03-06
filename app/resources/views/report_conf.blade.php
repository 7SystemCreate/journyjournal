@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">通報理由確認</h1>
    <form action="{{ route('report.comp') }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post['id'] }}">
        <div class="form-group">
            <textarea id="report_reason" name="report_reason" rows="5" class="form-control" readonly>{{ $report['report_reason'] }}</textarea>
        </div>
        <div class="form-group text-center mt-4">
            <a href="{{ route('post.report', ['post' => $post->id]) }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary">確定</button>
        </div>
    </form>
</div>
@endsection
