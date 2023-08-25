{{-- @extends('layouts.app')


 下記に表示したカレンダー以外の選択肢をforeachで並べていく。
@section('content')
<div>aa</div>

 イメージとして、カレンダー１つ

@endsection

--}}

@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{ $calendar->getTitle() }}</div>
               <div class="card-body">
					{!! $calendar->render() !!}
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
