@extends('layouts.app')
@section('content')
    <div class="d-flex flex-column align-items-center">
        <img class="text-center" src="https://i.imgur.com/y4yep47.png" alt="重複したカレンダーの図形">
        <a href="{{ route('calendar.index') }}" class="btn btn-light w-25 m-3 border border-dark" role="button">カレンダーを使用する</a>
        <h1>✅西暦・月を<u class="fw-bold">重複</u>してカレンダーを生成できる！</h1>
        <ul class="m-5">
            <li class="h2">予定や計画ごとにカレンダーを使用できます</li>
            <li class="h2">使い捨てメモ感覚でカレンダーを使用できます</li>
        </ul>
    </div>
@endsection
