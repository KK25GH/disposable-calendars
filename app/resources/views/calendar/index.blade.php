@extends('layouts.app')
@section('content')
<div class="container-fluid">
   <div class="row justify-content-center">
        <div class="col-md-8"><p class="create">編集　新規作成</p></div>
   </div>
   <div class="row justify-content-center">
       <div class="col-md-2"></div>
       <div class="col-md-8">
            @if($calendar != null)
                <div class="card">
                    <div class="card-header">{{ $calendar->getTitle() }}</div>
                    <div class="card-body">
                            {!! $calendar->render() !!}
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-header">登録されたカレンダーがありません。</div>
                </div>
            @endif
       </div>
       <div class="col-md-2">
            <div class="card">
                <div class="card-header">カレンダーリスト</div>
                    {{-- item example --}}
                    <div class="list-group-scroll">
                        <div class="list-group list-group-flush">
                          @foreach ($calendars as $item)
                            <a href="#" class="list-group-item list-group-item-action"><p>{{$item->title}}</p>{{$item->year}}年{{$item->month}}月</a>
                          @endforeach
                        </div>
                      </div>
                </div>
            </div>
       </div>
   </div>
</div>
@endsection
