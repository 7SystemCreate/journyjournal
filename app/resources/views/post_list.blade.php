@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        @if ($posts->isNotEmpty()) 
            @foreach ($posts as $post)
                <div class="col-12 mb-4">
                    <div class="card d-flex flex-row align-items-center p-3">
                        <div class="col-8 d-flex flex-column">
                            <!-- タイトル -->
                            <h5 class="mb-2">
                                <a href="{{ route('delete.detail', ['post' => $post['id']]) }}">
                                    {{ $post->title }}
                                </a>
                            </h5>

                            <!-- 内容 (100字まで表示) -->
                            <p class="mb-2">{{ Str::limit($post->comment, 100) }}</p>

                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted mb-0">
                                    @if ($post->user)
                                        {{ $post->user->name }}
                                    @else
                                        投稿者不明
                                    @endif
                                </p>
                                <p class="text-danger mb-0">
                                    通報件数: {{ $post->report_flg }}
                                </p>
                            </div>
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
