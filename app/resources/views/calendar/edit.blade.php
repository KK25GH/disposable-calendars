@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row flex-column align-items-center justify-content-center">
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center"><strong>タイトルを変更してください。&emsp;ID:【{{ $id }}】</strong></h5>
                    </div>
                    <div class="center">
                        {{ Form::open(['url' => route('calendar.update')]) }} {{ Form::hidden('id', $id) }}

                        {{ Form::text('title', $editTitle, ['class' => 'form-control form-control-lg', 'placeholder' => '例）大学のスケジュール', 'style' => 'border:none']) }}
                    </div>
                </div>
            </div>
            <div class="col-md-8 text-end">

                <a href="{{ route('calendar.index') }}" class="btn btn-light border">キャンセル</a>

                {{ Form::submit('保存', ['class' => 'btn btn-light px-4 border']) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
