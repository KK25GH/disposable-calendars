@extends('layouts.app')
@section('content')
    <div class="container-fluid create-vertical-center">
        <div class="row justify-content-center">
            <div class="col-md-8 margin-bottom">
                <div class="card">
                    <div class="card-header">
                        <h5 class="center"><strong>タイトルを変更してください。&emsp;ID:【{{$id}}】</strong></h5>
                    </div>
                    <div class="center">
                        {{ Form::open(['url' => route('calendar.update')]) }}

                        {{ Form::open(['url' => route('calendar.update')]) }} {{ Form::hidden('id', $id) }}

                        {{ Form::text('title', $editTitle, ['class' => 'form-control form-control-lg', 'placeholder' => '例）大学のスケジュール', 'style' => 'border:none' ]) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 right">

                <a href="{{ route('calendar.index') }}" class="btn btn-light border">キャンセル</a>

                {{ Form::submit('保存', ['class' => 'btn btn-light px-4 border']) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
