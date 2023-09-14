@extends('layouts.app')
@section('content')
    <div class="container-fluid vertical-center">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center"><strong>タイトルを入力してください。</strong></h5>
                    </div>
                    <div>
                        {{ Form::open(['url' => route('calendar.store')]) }}

                        {{ Form::text('title', '', ['class' => 'form-control form-control-lg', 'placeholder' => '例）大学のスケジュール', 'style' => 'border:none']) }}
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-header text-center">
                        <h5><strong>年・月を指定してください。</strong></h5>
                    </div>
                    <h1 class="card-body text-center">
                        {!! Form::select(
                            'selectedYear',
                            array_combine(range($thisYear, $thisYear + 49), range($thisYear, $thisYear + 49))
                        ) !!}
                        年
                        {!! Form::select('selectedMonth', array_combine(range(1, 12), range(1, 12)), $thisMonth) !!}
                        月
                    </h1>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 text-end">
                    <a href="{{ route('calendar.index') }}" class="btn btn-light border">キャンセル</a>

                    {{ Form::submit('作成', ['class' => 'btn btn-light px-4 border']) }}

                    {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
