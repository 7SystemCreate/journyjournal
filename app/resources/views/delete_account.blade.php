@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-5 text-center">
                <h2 class="mb-4 fw-bold">削除確認</h2>

                <form action="{{ route('myaccount.delete', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4 text-start mx-auto" style="max-width: 500px;">
                        <!-- ユーザ名 -->
                        <div class="row mb-3 align-items-center">
                            <label class="col-md-4 text-end fw-bold fs-5">ユーザ名:</label>
                            <div class="col-md-8 fs-5">
                                {{ Auth::user()->name }}
                            </div>
                        </div>

                        <!-- メールアドレス -->
                        <div class="row mb-3 align-items-center">
                            <label class="col-md-4 text-end fw-bold fs-5">メールアドレス:</label>
                            <div class="col-md-8 fs-5">
                                {{ Auth::user()->email }}
                            </div>
                        </div>

                        <!-- アイコンプレビュー -->
                        <div class="row mb-3 align-items-center">
                            <label class="col-md-4 text-end fw-bold fs-5">アイコン:</label>
                            <div class="col-md-8 text-center">
                                <!-- 現在のアイコンを表示（デフォルトアイコン対応） -->
                                <img src="{{ Auth::user()->icon ? asset('storage/' . Auth::user()->icon) : asset('storage/icons/default.png') }}" 
                                     class="rounded-circle border shadow-sm mb-3"
                                     style="width: 100px; height: 100px; object-fit: cover;" 
                                     alt="現在のアイコン">
                            </div>
                        </div>
                    </div>

                    <!-- ボタン -->
                    <div class="mt-3 d-flex justify-content-between">
                        <a href="{{ route('account.edit') }}" class="btn btn-secondary btn-lg px-4 py-2">
                            <i class="fas fa-arrow-left me-2"></i>戻る
                        </a>
                        <button type="submit" class="btn btn-danger btn-lg px-4 py-2">
                            <i class="fas fa-save me-2"></i>削除する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
