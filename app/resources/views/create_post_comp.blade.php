@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 text-center">
                <h2 class="mb-3">投稿が完了しました</h2>
                <p class="text-muted">投稿内容はメイン画面から確認できます。</p>

                <div class="mt-4">
                    <a href="{{ route('inn.home')}}" class="btn btn-primary btn-lg">メイン画面へ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
