@extends('layouts.app')
@section('content')
    <div class="container-fluid vertical-center">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-3">
                <div class="card alert alert-danger">
                    <div class="card-header center">
                        <div class="row">
                            <h2>{{$calendar->year}}年&emsp;{{$calendar->month}}月&emsp;</h2>
                            </div>
                        <div class="row"><h2>【{{$calendar->title}}】</h2></div>
                    </div>
                    <div class="card-body">
                        <h1 class="center"><strong >本当に削除しますか？</strong></h1>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::open(['url' => route('calendar.delete_confirm')]) }}
        {{ Form::hidden('id', $calendar->id) }}
        <div class="row justify-content-center">
            <div class="d-grid col-md-4 center">
                    <a href="{{ route('calendar.index') }}" class="btn btn-light border">いいえ</a>
            </div>
            <div class="d-grid col-md-4 center">
                    {{ Form::submit('はい', ['class' => 'btn btn-light px-4 border ']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
