@extends('layouts.app')
@section('content')
<div class="container-fluid">
   <div class="row justify-content-center">
        <div class="col-md-8"><p class="create">編集　新規作成</p></div>
   </div>
   <div class="row justify-content-center">
       <div class="col-md-2"></div>
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{ $calendar->getTitle() }}</div>
               <div class="card-body">
					{!! $calendar->render() !!}
               </div>
           </div>
       </div>
       <div class="col-md-2">
            <div class="card">
                <div class="card-header">カレンダーリスト</div>
                    {{-- item example --}}
                    <div class="list-group-scroll">
                        <div class="list-group list-group-flush">
                          <a href="#" class="list-group-item list-group-item-action">An item</a>
                          <a href="#" class="list-group-item list-group-item-action">A second item</a>
                          <a href="#" class="list-group-item list-group-item-action">A third item</a>
                          <a href="#" class="list-group-item list-group-item-action">A fourth item</a>
                          <!-- more items -->
                        </div>
                      </div>

                </div>
            </div>
       </div>
   </div>
</div>
@endsection
