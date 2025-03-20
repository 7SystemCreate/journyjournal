@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-5 text-center">
                <h2 class="mb-4 fw-bold">アカウント情報確認</h2>

                <form action="{{ route('account.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4 text-start mx-auto" style="max-width: 500px;">
                        <div class="row mb-3 align-items-center">
                            <label class="col-md-4 text-end fw-bold fs-5">ユーザ名:</label>
                            <div class="col-md-8 fs-5">
                                {{ $userData['name'] }}
                                <input type="hidden" name="name" value="{{ $userData['name'] }}">
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label class="col-md-4 text-end fw-bold fs-5">メールアドレス:</label>
                            <div class="col-md-8 fs-5">
                                {{ $userData['email'] }}
                                <input type="hidden" name="email" value="{{ $userData['email'] }}">
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label class="col-md-4 text-end fw-bold fs-5">アイコン:</label>
                            <div class="col-md-8">
                                @if(isset($userData['icon']))
                                    <img src="{{ asset('storage/' . $userData['icon']) }}" 
                                         class="rounded-circle border shadow-sm" 
                                         style="width: 100px; height: 100px; object-fit: cover; " 
                                         alt="アイコン">
                                    <input type="hidden" name="icon" value="{{ $userData['icon'] }}">
                                @else
                                    <p class="text-muted">変更なし</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 d-flex justify-content-between">
                        <a href="{{ route('account.edit') }}" class="btn btn-secondary btn-lg px-4 py-2">
                            <i class="fas fa-arrow-left me-2"></i>戻る
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg px-4 py-2">
                            <i class="fas fa-save me-2"></i>更新する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
