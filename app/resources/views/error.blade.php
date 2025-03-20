@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 text-center">
                <h2 class="mb-3 text-danger">エラーが発生しました</h2>
                <p class="text-muted">予期しない問題が発生しました。</p>

                <div class="mt-4">
                    <a href="{{ route('home') }}" class="btn btn-primary btn-lg">メイン画面へ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
