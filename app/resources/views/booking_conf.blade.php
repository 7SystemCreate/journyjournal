@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <!-- 左側: 確認内容 -->
        <div class="col-md-6">
            <div class="card p-4 h-100">
                <h4 class="mb-3">予約内容の確認</h4>
                <table class="table">
                    <tr>
                        <th>氏名</th>
                        <td>{{ $booking['name'] }}</td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td>{{ $booking['tel'] }}</td>
                    </tr>
                    <tr>
                        <th>チェックイン日</th>
                        <td>{{ $booking['checkin_date'] }}</td>
                    </tr>
                    <tr>
                        <th>チェックアウト日</th>
                        <td>{{ $booking['checkout_date'] }}</td>
                    </tr>
                    <tr>
                        <th>予約人数</th>
                        <td>{{ $booking['booking_people'] }}人</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-center">
                    <form action="{{ route('booking.comp') }}" method="POST">
                        @csrf
                        <input type="hidden" name="name" value="{{ $booking['name'] }}">
                        <input type="hidden" name="tel" value="{{ $booking['tel'] }}">
                        <input type="hidden" name="checkin_date" value="{{ $booking['checkin_date'] }}">
                        <input type="hidden" name="checkout_date" value="{{ $booking['checkout_date'] }}">
                        <input type="hidden" name="booking_people" value="{{ $booking['booking_people'] }}">
                        <input type="hidden" name="post_id" value="{{ $post['id'] }}">

                        <button type="submit" class="btn btn-success">予約確定</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- 右側: 予約のタイトル・料金詳細 -->
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
@endsection
