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

                <!-- 投稿者情報 -->
                <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/' . ($post->user->icon ?? 'images/icon/defaulticon.png')) }}" 
                         class="rounded-circle me-2"
                         style="width: 50px; height: 50px; object-fit: cover;"
                         alt="ユーザーアイコン">
                    <p class="mb-0">{{ $post->user->name ?? '投稿者不明' }}</p>
                </div>

                <!-- ボタン -->
                <div class="mt-3 d-flex justify-content-between">
                    <!-- いいねボタン -->
                    @auth
                        @if ($post->isLikedByUser(Auth::id()))
                            <button id="like-btn-{{ $post->id }}" type="button" class="btn btn-outline-danger"
                                    onclick="unlikePost({{ $post->id }})">
                                いいねを取り消す <span id="like-count-{{ $post->id }}">{{ $post->likeCount() }}</span>
                            </button>
                        @else
                            <button id="like-btn-{{ $post->id }}" type="button" class="btn btn-outline-primary"
                                    onclick="likePost({{ $post->id }})">
                                いいね！ <span id="like-count-{{ $post->id }}">{{ $post->likeCount() }}</span>
                            </button>
                        @endif
                    @else
                        <button type="button" class="btn btn-outline-primary" disabled>
                            ログインしていいね！
                            <span id="like-count-{{ $post->id }}">{{ $post->likeCount() }}</span>
                        </button>
                    @endauth

                    <!-- 通報ボタン -->
                    <a href="{{ route('post.report', ['post' => $post['id']]) }}" class="btn btn-warning">通報</a>

                    <!-- 予約ボタン -->
                    <a href="{{ route('booking', ['post' => $post['id']]) }}" class="btn btn-success">予約する</a>
                </div>
            </div>
        </div>
    </div>

    <!-- コメント (投稿の説明文) を予約ボタンの下に配置 -->
    <div class="card mt-4 p-4">
        <h4>詳細</h4>
        <p>{{ $post->comment }}</p>
    </div>
</div>

<!-- Ajax用のスクリプト -->
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
                    $('#like-count-' + postId).text(response.like_count);
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
                    $('#like-count-' + postId).text(response.like_count);
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

@endsection
