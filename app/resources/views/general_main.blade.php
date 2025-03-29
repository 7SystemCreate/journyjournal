@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form method="POST" action="{{ url('/') }}">
                @csrf
                <div class="card p-4">
                    <div class="card-header text-center">検索フォーム</div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="col-md-3 mb-2">
                                <label for="search" class="form-label">キーワード検索</label>
                                <input type="text" class="form-control" name="search" placeholder="キーワードを入力"
                                       value="{{ isset($search) ? $search : '' }}">
                            </div>

                            <div class="col-md-3 mb-2">
                                <label for="start_date" class="form-label">宿泊可能日</label>
                                <input type="date" class="form-control" name="start_date" id="start_date"
                                       value="{{ isset($start_date) ? $start_date : '' }}">
                                <span class="d-block text-center">～</span>
                                <input type="date" class="form-control" name="end_date" id="end_date"
                                       value="{{ isset($end_date) ? $end_date : '' }}">
                            </div>

                            <div class="col-md-3 mb-2">
                                <label for="price_range" class="form-label">金額</label>
                                <select class="form-control" name="price_range">
                                    <option value="">金額を選択</option>
                                    <option value="1" {{ isset($price_range) && $price_range == '1' ? 'selected' : '' }}>~5000円</option>
                                    <option value="2" {{ isset($price_range) && $price_range == '2' ? 'selected' : '' }}>5000円~10000円</option>
                                    <option value="3" {{ isset($price_range) && $price_range == '3' ? 'selected' : '' }}>10000円~20000円</option>
                                    <option value="4" {{ isset($price_range) && $price_range == '4' ? 'selected' : '' }}>20000円~</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center py-2">
                            <button type="submit" class="btn btn-primary">検索</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-4">
        @if ($posts->isNotEmpty())
            @foreach ($posts as $post)
                <div class="col-12 mb-4">
                    <div class="card d-flex flex-row align-items-center p-3">
                        <div class="col-4">
                            <a href="{{ route('post.detail', ['post' => $post['id']]) }}">
                                <img src="{{ asset('storage/' . ($post->image)) }}" class="img-fluid rounded" alt="投稿画像">
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
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 text-center mt-3">
                <p>投稿がありません。</p>
            </div>
        @endif
    </div>
</div>


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


@endsection
