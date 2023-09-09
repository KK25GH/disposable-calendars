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

        //イメージとして、最後に使用したカレンダーのidを変数に保存し、次に呼び出すときに使う。

        //テスト：最後に作ったカレンダーのみを変数にいれる。
        $firstview = Calendar::where(['user_id' => Auth::id()])
        ->orderBy('created_at','desc')
        ->first();

        $year = $firstview->year;
        $month = $firstview->month;
        if($year === null || $month === null) {
            $date = null;
        } else {
            $date = "{$year}-{$month}-01 00:00:00";
        }

        //ログイン後前回最後に表示したカレンダーを表示する。
            $calendar = $this->shows($date);
        //データをviewに渡す。左側は送る先のview、右は送りたいデータ
        return view('calendar.index', compact('calendars','calendar'));

    }

    //カレンダーを生成するメソッド

    public function shows($date){



		if($date != null){
            $calendar = new CalendarView($date);

            return $calendar;
        } else {
            $calendar = null;
            return $calendar;
        }
	}


    /**
     * Calendar新規作成画面
     */
    public function create()
    {
        $thisYear = date('Y');
        $thisMonth = date('n');

        return view('calendar.create', compact('thisYear','thisMonth'));
    }



}


