@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-5 text-center">
                <h2 class="mb-4 fw-bold">アカウント情報編集</h2>

                <form action="{{ route('account.edit.conf') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4 text-start mx-auto" style="max-width: 500px;">
                        <div class="row mb-3 align-items-center">
                            <label class="col-md-4 text-end fw-bold fs-5">ユーザ名:</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control fs-5" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label class="col-md-4 text-end fw-bold fs-5">メールアドレス:</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control fs-5" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label class="col-md-4 text-end fw-bold fs-5">アイコン:</label>
                            <div class="col-md-8 text-center">
                                <img src="{{ Auth::user()->icon ? asset('storage/' . Auth::user()->icon) : asset('storage/icons/default.png') }}" 
                                     class="rounded-circle border shadow-sm mb-3"
                                     style="width: 100px; height: 100px; object-fit: cover;" 
                                     alt="現在のアイコン">
        
                                <input type="file" class="form-control fs-5 mt-2" name="icon">
                            </div>
                        </div>
                    </div>

                    <!-- ボタン部分 -->
                    <div class="mt-3 d-flex justify-content-between">
                        <a href="{{ route('account.delete') }}" class="btn btn-danger btn-lg px-4 py-2">
                            <i class="fas fa-trash-alt me-2"></i>アカウント削除
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg px-4 py-2">
                            <i class="fas fa-check-circle me-2"></i>編集内容確認
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
