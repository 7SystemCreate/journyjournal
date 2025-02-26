@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 text-center">
                <h2 class="mb-3">予約が完了しました</h2>
                <p class="text-muted">ご予約いただきありがとうございます。詳細はマイページから確認できます。</p>

                <div class="mt-4">
                    <a href="{{ route('general.main') }}" class="btn btn-primary btn-lg">メイン画面へ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
