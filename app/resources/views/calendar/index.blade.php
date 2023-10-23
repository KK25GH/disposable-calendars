@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-2"></div>
            <div class="col-md-8 mb-1 text-end">
                <a href="{{ route('calendar.delete_request', ['id' => $id]) }}" class="btn btn-light">削除</a>
                <a href="{{ route('calendar.edit', ['editTitle' => $title, 'id' => $id]) }}" id="calendar_id" class="btn btn-light" data-id="{{$id}}">編集</a><a
                    href="{{ route('calendar.create') }}" class="btn btn-light ms-1">新規作成</a>
            </div>
            <div class="col-md-2"></div>
            <div class="row justify-content-center">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    @if ($calendar != null)
                        <div class="card">
                            <div class="card-header">
                                {{ $calendar->getTitle() }}&emsp;&emsp;{{ $title }}&emsp;【id:0{{ $id }}】
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
                <div class="col-md-2">
                    @if (count($calendars) != 0)
                    <div class="d-flex flex-row justify-content-center mb-1">
                    <a href="{{ route('calendar.index', ['asc' => true]) }}" class="col-md-5 btn btn-light">昇順</a>
                    <a href="{{ route('calendar.index') }}" class="col-md-5 btn btn-light ms-2">降順</a>
                    </div>
                        <div class="card">
                            <div class="card-header">
                                カレンダーリスト
                            </div>
                            {{-- item example --}}
                            <div class="list-group-scroll">
                                <div class="list-group list-group-flush">
                                    @foreach ($calendars as $item)
                                        <a href="{{ route('calendar.index', ['title' => $item->title, 'year' => $item->year, 'month' => $item->month, 'id' => $item->id]) }}"
                                            class="list-group-item list-group-item-action">
                                            <p>{{ $item->title }}</p>{{ $item->year }}年{{ $item->month }}月
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
