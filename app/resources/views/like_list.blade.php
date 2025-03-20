@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <h2 class="text-center font-weight-bold my-4">いいね一覧</h2>
    
    @if ($posts->isNotEmpty()) 
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-12 mb-4">
                    <div class="card d-flex flex-row align-items-center p-3">
                        <div class="col-4">
                            <a href="{{ route('post.detail', ['post' => $post['id']]) }}">
                                <img src="{{ asset('storage/' . ($post->image ?? 'images/postimages/defaultimage.png')) }}" 
                                     class="img-fluid rounded" alt="投稿画像">
                            </a>
                        </div>

                        <div class="col-8 d-flex flex-column">
                            <!-- タイトル -->
                            <h5 class="mb-2">
                                <a href="{{ route('post.detail', ['post' => $post['id']]) }}">
                                    {{ $post->title }}
                                </a>
                            </h5>

                            <!-- 内容 (100字まで表示) -->
                            <p class="mb-2">{{ Str::limit($post->comment, 100) }}</p>

                            <!-- ユーザ名 & いいねボタン -->
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted mb-0">
                                    @if ($post->user)
                                        {{ $post->user->name }}
                                    @else
                                        投稿者不明
                                    @endif
                                </p>
                                <!-- いいねボタン -->
                                @auth
                                    @if ($post->isLikedByUser(Auth::id()))
                                        <!-- いいね済みボタン -->
                                        <button id="like-btn-{{ $post->id }}" type="button" class="btn btn-outline-danger"
                                                onclick="unlikePost({{ $post->id }})">
                                            いいねを取り消す <span id="like-count-{{ $post->id }}">{{ $post->likeCount() }}</span>
                                        </button>
                                    @else
                                        <!-- まだいいねしていないボタン -->
                                        <button id="like-btn-{{ $post->id }}" type="button" class="btn btn-outline-primary"
                                                onclick="likePost({{ $post->id }})">
                                            いいね！ <span id="like-count-{{ $post->id }}">{{ $post->likeCount() }}</span>
                                        </button>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>まだ「いいね」をした投稿がありません。</p>
    @endif
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function likePost(postId) {
        $.ajax({
            url: '{{ route('post.like', ['post' => ':post_id']) }}'.replace(':post_id', postId),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    // いいね数を更新
                    $('#like-count-' + postId).text(response.like_count);

                    // ボタンの切り替え
                    $('#like-btn-' + postId)
                        .removeClass('btn-outline-primary')
                        .addClass('btn-outline-danger')
                        .html(`いいねを取り消す <span id="like-count-${postId}">${response.like_count}</span>`)
                        .attr('onclick', 'unlikePost(' + postId + ')');
                } else {
                    alert('いいねの追加に失敗しました。');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('エラーが発生しました: ' + errorThrown);
                console.error(jqXHR.responseText);
            }
        });
    }

    function unlikePost(postId) {
        $.ajax({
            url: '{{ route('post.unlike', ['post' => ':post_id']) }}'.replace(':post_id', postId),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    // いいね数を更新
                    $('#like-count-' + postId).text(response.like_count);

                    // ボタンの切り替え
                    $('#like-btn-' + postId)
                        .removeClass('btn-outline-danger')
                        .addClass('btn-outline-primary')
                        .html(`いいね！ <span id="like-count-${postId}">${response.like_count}</span>`)
                        .attr('onclick', 'likePost(' + postId + ')');
                } else {
                    alert('いいねの削除に失敗しました。');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('エラーが発生しました: ' + errorThrown);
                console.error(jqXHR.responseText);
            }
        });
    }
</script>
