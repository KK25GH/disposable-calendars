@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row flex-column align-items-center justify-content-center">
            <div class="col-md-8 mb-3">
                <div class="card alert alert-danger">
                    <div class="card-header text-center">
                        <h2>{{ $calendar->year }}年&emsp;{{ $calendar->month }}月&emsp;</h2>
                        <h2>【{{ $calendar->title }}】</h2>
                    </div>
                    <div class="card-body">
                        <h1 class="text-center"><strong>本当に削除しますか？</strong></h1>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-center">
                <div class="col-md-3 text-center">
                    <a href="{{ route('calendar.index') }}" class="btn btn-light border w-100">いいえ</a>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3 text-center">
                    {{ Form::open(['url' => route('calendar.delete_confirm')]) }}
                    {{ Form::hidden('id', $calendar->id) }}
                    {{ Form::submit('はい', ['class' => 'btn btn-light  border w-100']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
