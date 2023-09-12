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

        if($firstview != null) {
            $year = $firstview->year;
            $month = $firstview->month;
        } else {
            $year = null;
            $month = null;
        }

        if($year === null || $month === null) {
            $date = null;
        } else if($request->title == null && $request->year == null && $request->month == null ) {
            //リクエスト変数にタイトル、年、月がnullだった場合はfirstview
            $date = "{$year}-{$month}-01 00:00:00";
        } else {
            //リクエスト変数に値が入っていた場合＝＞カレンダーリストからのリクエスト
            $date = "{$request->year}-{$request->month}-01 00:00:00";
        }

        if($firstview != null && $request->title == null ) {
            $title = $firstview->title;
        } else if($firstview == null) {
            $title = null;
        } else {
            $title = $request->title;
        }
        //実装：最後に作成されたカレンダーを最初に表示する。
        //未実装：ログイン後前回最後に表示したカレンダーを表示する。
            $calendar = $this->shows($date);
        //データをviewに渡す。左側は送る先のview、右は送りたいデータ
        return view('calendar.index', compact('calendars','calendar','title'));

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
     * Calendar作成画面への遷移
     */
    public function create()
    {
        $thisYear = date('Y');
        $thisMonth = date('n');

        return view('calendar.create', compact('thisYear','thisMonth'));
    }

    /**
     * Calendar作成（データベースへの保存）
     */
    public function store(Request $request)
    {
        //バリデーション = 妥当性の確認
        $request->validate([
            //タイトル文字上限255文字
            'title' => 'required|max:255',
        ]);

        //受け取った変数をデータベースへ挿入する。
        Calendar::create(
            [
                'user_id' => Auth::id(),
                'title' => $request->title,
                'year' => $request->selectedYear,
                'month' => $request->selectedMonth
            ]
        );
        return redirect()->route('calendar.index');
    }

    /**
     * Calendar編集画面への遷移
     */
    public function edit(Request $request)
    {
        $request->validate(['editTitle'=>'required']);

        $editTitle = $request->editTitle;
        return view('calendar.edit', compact('editTitle'));
    }




}


