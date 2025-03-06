@extends('layouts.layout')

@section('content')

<div class="container-fluid" style="margin-top: 20px;">
    <!-- 新規投稿ボタン -->
    <div class="row mb-4">
        <div class="col-12 text-left">
            <a href="{{ route('create.post') }}" class="btn btn-success">新規投稿</a>
        </div>
    </div>

    <div class="row">
        @if ($posts->isNotEmpty()) 
            @foreach ($posts as $post)
                <div class="col-12 mb-4">
                    <div class="card d-flex flex-row align-items-center p-3">
                        <div class="col-4">
                            <a href="{{ route('mypost.detail', ['post' => $post['id']]) }}">
                                <img src="{{ asset('storage/' . ($post->image ?? 'images\postimages\defaultimage.png')) }}" class="img-fluid rounded" alt="投稿画像">
                            </a>
                        </div>

                        <div class="col-8 d-flex flex-column">
                            <!-- タイトル -->
                            <h5 class="mb-2">
                                <a href="{{ route('mypost.detail', ['post' => $post['id']]) }}">
                                    {{ $post->title }}
                                </a>
                            </h5>
                            <!-- 内容 (100字まで表示) -->
                            <p class="mb-2">{{ Str::limit($post->comment, 100) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>投稿がありません。</p>
        @endif
    </div>
</div>

@endsection
