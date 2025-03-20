@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <!-- 左側: 投稿の詳細情報 -->
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

        <!-- 右側: 料金詳細と予約ボタン -->
        <div class="col-md-6">
            <div class="card p-4 h-100 d-flex flex-column justify-content-between">
                <h4 class="mb-3">{{ $post->title }}</h4>
                <p class="text-muted">{{ $post->comment }}</p>
                <div class="bg-light p-3 rounded text-center">
                    <p class="fw-bold fs-4 mb-0">金額: {{ number_format($post->amount) }} 円</p>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <form id="cancel-form" action="{{ route('booking.delete.confirm', ['booking' => $booking->id]) }}" method="POST">
                        @csrf
                        <button type="button" class="btn btn-danger" onclick="confirmCancel()">予約キャンセル</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmCancel() {
    if (confirm("本当にこの予約をキャンセルしますか？")) {
        document.getElementById("cancel-form").submit();
    }
}
</script>

@endsection
