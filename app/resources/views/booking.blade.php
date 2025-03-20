@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card p-4 h-100">
                <h4 class="mb-3">予約情報を入力</h4>
                    <div class= 'panel-body'>
                        @if($errors->any())
                        <div class='alert alert-danger'>
                            <ul>
                                @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                <form action="{{ route('booking.conf', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="mb-3">
                        <label class="form-label">氏名</label>
                        <input type="text" name="name" value="{{ old('name')}}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">電話番号</label>
                        <input type="tel" name="tel" value="{{ old('tel')}}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">チェックイン日</label>
                        <input type="date" name="checkin_date" class="form-control" value="{{ $post->date }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">チェックアウト日</label>
                        <input type="date" name="checkout_date" class="form-control" value="{{ \Carbon\Carbon::parse($post->date)->addDay()->format('Y-m-d') }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">予約人数</label>
                        <input type="number" name="booking_people" value="{{ old('booking_people')}}" class="form-control" min="1" max="{{ $post->max_people }}" required>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-success btn-lg">確認</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-4 h-100">
                <h4 class="mb-3">{{ $post->title }}</h4>
                <p class="text-muted">{{ $post->comment }}</p> <!-- コメント -->

                <div class="bg-light p-3 rounded text-center mt-4">
                    <p class="fw-bold fs-3 mb-0">金額: {{ number_format($post->amount) }} 円</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
