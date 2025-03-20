@extends('layouts.layout')

@section('content')
<div class="container">
    <h2 class="text-center font-weight-bold my-4">予約一覧</h2>

    @if($bookings->isEmpty())
        <p>現在、予約はありません。</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>予約者氏名</th>
                    <th>チェックイン日</th>
                    <th>チェックアウト日</th>
                    <th>予約人数</th>
                    <th>料金</th>
                    <th>予約日</th>
                    <th>ステータス</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->checkin_date }}</td>
                    <td>{{ $booking->checkout_date }}</td>
                    <td>{{ $booking->booking_people }}人</td>
                    <td>{{ $booking->post->amount }}円</td>
                    <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('inn.booking.detail', ['booking' => $booking->id]) }}" class="btn btn-primary btn-sm">
                            詳細を見る
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
