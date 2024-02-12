@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-2"></div>
        <div class="col-md-8 mb-1 text-end">
            <a href="{{ route('/') }}" class="btn btn-light border readme">TOP</a>
            <a href="{{ route('calendar.delete_request', ['id' => $id]) }}" class="btn btn-light border">削除</a>
            <a href="{{ route('calendar.edit', ['editTitle' => $title, 'id' => $id]) }}" id="calendar_id" class="btn btn-light border" data-id="{{$id}}">編集</a><a
                href="{{ route('calendar.create') }}" class="btn btn-light ms-1 border">新規作成</a>
        </div>
        <div class="col-md-2">
            @include('calendarParts.calendarList')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-11">
            @if ($calendar != null)
                <div class="card">
                    <div class="card-header">
                        {{ $calendar->getTitle() }}&emsp;{{ $title }}&emsp;【id:{{ $id }}】
                    </div>
                    <div class="card-body">
                        {!! $calendar->render() !!}
                    </div>
                </div>
            @else
                @if ($errors->has('editTitle'))
                    <div class="alert alert-danger">
                        <strong>編集できるカレンダーがありません。</strong>
                    </div>
                @elseif ($errors->has('id'))
                    <div class="alert alert-danger">
                        <strong>削除できるカレンダーがありません。</strong>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">登録されているカレンダーがありません。</div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
