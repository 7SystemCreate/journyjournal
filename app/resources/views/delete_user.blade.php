@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-5 text-center">
                <h2 class="mb-4 fw-bold">削除確認</h2>

                <div class="mb-5 text-start mx-auto" style="max-width: 500px;">
                    <div class="row mb-4 align-items-center">
                        <div class="col-md-4 text-end fw-bold fs-4 text-nowrap">メールアドレス:</div>
                        <div class="col-md-8 fs-4 text-break">{{ $user->email }}</div>
                    </div>
                    <div class="row mb-4 align-items-center">
                        <div class="col-md-4 text-end fw-bold fs-4 text-nowrap">役割:</div>
                        <div class="col-md-8 fs-4">
                            @if($user->role == 1)
                                旅館運営ユーザ
                            @else
                                一般ユーザ
                            @endif
                        </div>
                    </div>
                    <div class="row mb-4 align-items-center">
                        <div class="col-md-4 text-end fw-bold fs-4 text-nowrap">アイコン:</div>
                        <div class="col-md-8">
                            <img src="{{ asset('storage/' . $user->icon) }}" 
                                 class="rounded-circle border shadow-sm" 
                                 style="width: 50px; height: 50px; object-fit: cover;" 
                                 alt="ユーザーアイコン">
                        </div>
                    </div>
                </div>

                <!-- ボタン -->
                <div class="mt-3 d-flex justify-content-center">
                    <!-- 削除ボタン（formでPOSTリクエストを送る） -->
                    <form action="{{ route('user.delete', $user->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-danger">投稿を削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 削除確認用JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteForms = document.querySelectorAll(".delete-form");
        deleteForms.forEach(form => {
            form.addEventListener("submit", function (event) {
                if (!confirm("このユーザを削除してもよろしいですか？")) {
                    event.preventDefault(); // キャンセルされた場合、削除処理を中止
                }
            });
        });
    });
</script>

@endsection
