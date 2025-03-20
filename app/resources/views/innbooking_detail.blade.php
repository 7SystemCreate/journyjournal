@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card p-4 h-100">
                <h4 class="mb-3">予約内容確認</h4>
                <table class="table">
                    <tr>
                        <th>予約者氏名</th>
                        <td>{{ $booking->name }}</td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td>{{ $booking->tel }}</td>
                    </tr>
                    <tr>
                        <th>チェックイン時間</th>
                        <td>{{ $booking->checkin_date }}</td>
                    </tr>
                    <tr>
                        <th>チェックアウト時間</th>
                        <td>{{ $booking->checkout_date }}</td>
                    </tr>
                    <tr>
                        <th>人数</th>
                        <td>{{ $booking->booking_people }}人</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-4 h-100 d-flex flex-column justify-content-between">
                <h4 class="mb-3">{{ $post->title }}</h4>
                <p class="text-muted">{{ $post->comment }}</p>
                <div class="bg-light p-3 rounded text-center">
                    <p class="fw-bold fs-4 mb-0">金額: {{ number_format($post->amount) }} 円</p>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
