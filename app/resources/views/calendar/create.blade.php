@extends('layouts.app')
@section('content')
    <div class="create-vertical-center">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="ymh1">

                                    <select name="" id="">
                                        @for($i=0; $i<50; $i++) {
                                            <option value="{{$thisYear + $i}}">{{$thisYear + $i}}</option>
                                        }
                                        @endfor
                                    </select>

                                    年

                                    <select name="" id="">
                                        @for($i=1; $i<=12; $i++) {
                                            <option value="{{$i}}">{{$i}}</option>
                                        }
                                        @endfor
                                    </select>

                                    月</h1>
                            </div>
                        </div>
                </div>
                    <div class="col-md-8">
                        <div class="CandS">
                            <h2>
                                <a>キャンセル</a><a>保存</a>
                            </h2>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
