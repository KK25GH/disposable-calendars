@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="create">
                    <a href="{{ route('calendar.delete_request', ['id' => $id]) }}" class="btn btn-light">削除</a>
                    <a href="{{ route('calendar.edit', ['editTitle' => $title, 'id' => $id]) }}"
                        class="btn btn-light">編集</a><a href="{{ route('calendar.create') }}" class="btn btn-light">新規作成</a>
                </div>
            </div>
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>編集できるカレンダーがありません。</strong>
                            </div>
                        @else
                            <div class="card">
                                <div class="card-body">登録されているカレンダーがありません。</div>
                            </div>
                        @endif
                    @endif
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-header">カレンダーリスト</div>
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
                </div>
            </div>
        </div>
    </div>
@endsection
