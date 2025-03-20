@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        @if ($users->isNotEmpty()) 
            @foreach ($users as $user)
                <div class="col-12 mb-4">
                    <div class="card d-flex flex-row align-items-center p-3">
                        <!-- 左側: ユーザー情報 -->
                        <div class="col-8 d-flex flex-column">
                            <h5 class="mb-2">{{ $user->name }}</h5>
                            <p class="mb-2"><strong>メールアドレス:</strong> {{ $user->email }}</p>
                            <p class="mb-2"><strong>ロール:</strong> 
                                {{ $user->role == 0 ? '一般ユーザ' : '旅館運営ユーザ' }}
                            </p>
                        </div>

                        <!-- 右下: 削除ボタン -->
                        <div class="col-4 d-flex justify-content-end align-items-end">
                            <a href="{{ route('delete.userdetail', ['user' => $user->id]) }}" class="btn btn-danger">削除確認</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>ユーザーがいません。</p>
        @endif
    </div>
</div>
@endsection
