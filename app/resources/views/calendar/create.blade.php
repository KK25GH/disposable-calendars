@extends('layouts.app')
@section('content')
    <div class="create-vertical-center">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8 margin-bottom">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="center">タイトルを入力してください。</h5>
                        </div>
                        <div class="center">
                            <input class="c_title" type="text">
                        </div>
                    </div>
            </div>
                <div class="col-md-8 margin-bottom">
                        <div class="card">
                            <div class="card-header center">
                                作成するカレンダーの西暦と月を指定してください。
                            </div>

                            <h1 class="center padding-top">

                                <select name="selectedYear">
                                    @for($i=0; $i<50; $i++) {
                                        <option value="{{$thisYear + $i}}">{{$thisYear + $i}}</option>
                                    }
                                    @endfor
                                </select>

                                年

                                <select name="selectedMonth">
                                    @for($i=1; $i<=12; $i++) {
                                        @if($i==$thisMonth)
                                            <option value="{{$i}}" selected>{{$i}}</option>
                                        @else
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endif
                                    }
                                    @endfor
                                </select>

                                月</h1>
                        </div>
                </div>
                    <div class="col-md-8">
                        <div class="right">


                            <a href="{{route('calendar.index')}}" class ="btn btn-light">キャンセル</a>
                            <a href="" class ="btn btn-light">作成</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
