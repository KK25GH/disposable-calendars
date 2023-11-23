@if (count($calendars) != 0)
<div class="card calendarListTitle">
    <details>
        <summary class="card-header">
            カレンダーリスト
        </summary>
        <div id="calendarList" class="list-group-scroll list-group list-group-flush">
            @foreach($calendars as $item)
                <a href="{{ route('calendar.index', ['title' => $item->title, 'year' => $item->year, 'month' => $item->month, 'id' => $item->id]) }}"class="list-group-item list-group-item-action">
                    <p data-id="{{$item->id}}">{{ $item->title }}</p><p>{{ $item->year }}年{{ $item->month }}月</p>
                </a>
            @endforeach
        </div>
    </details>
</div>
@endif

