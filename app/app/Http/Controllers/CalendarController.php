<?php

namespace App\Http\Controllers;

use App\Calendar\CalendarView;
use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    /**
     * ログインしているかを確認する。
     * している場合は、TodoControllerへアクセスできる。
     * していない場合は、ログインすることを要求する。
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * ログインしているユーザーのカレンダーとメモを表示する
     */
    public function index(Request $request)
    {
        //カレンダーを作ったのが最も最近なのを表示、hasがascならば古いものから表示
        if($request->has('asc')) {
            $calendars = Calendar::where(['user_id' => Auth::id() ])
                ->orderBy('created_at','asc')
                ->get();
        } else {
            //最初のリダイレクトでは、何も代入されていないので、elseの処理
            $calendars = Calendar::where(['user_id' => Auth::id() ])
                ->orderBy('created_at','desc')
                ->get();
        }

        //データをviewに渡す。左側は送る先のview、右は送りたいデータ
        return view('calendar.index', compact('calendars'));

    }

    //ログイン後前回最後に表示したカレンダーを表示する。

    public function show(){

        $view = null;

		if($view != null){
            $calendar = new CalendarView($view);

            return view('calendar.index', [
                //calendar.indexというビューファイルに、"calendar"という変数名で$calendarという値を渡しています。ビューファイルでは、{ {$calendar}}という形で変数を出力できます。
                "calendar" => $calendar
            ]);
        } else {
            $calendar = null;
            return view('calendar.index',[
                "calendar" => $calendar
            ]);
        }
	}


    /**
     * Calendar新規作成画面
     */



}


