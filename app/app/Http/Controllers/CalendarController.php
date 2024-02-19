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
     * している場合は、CalendarControllerへアクセスできる。
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
        // ユーザーIDに基づいてカレンダーデータを取得し、order_numで昇順、idで降順にソートします
        $calendars = Calendar::where('user_id', Auth::id())
            ->orderBy('order_num')
            ->orderByDesc('id')
            ->get();

        // カレンダーデータの最初の要素を取得します
        $first_view = $calendars->first();

        // 初期値を設定します
        $year = $month = $date = $id = $title = null;

        // $first_viewが存在する場合、そのデータを使用して年、月、日付、ID、タイトルを設定します
        if ($first_view) {
            $year = $first_view->year;
            $month = $first_view->month;
            $date = "{$year}-{$month}";
            $id = $first_view->id;
            $title = $first_view->title;
        }

        // リクエストに年と月とタイトルが含まれている場合、それらの値を使用して日付とIDとタイトルを更新します
        if ($request->year && $request->month && $request->title) {
            $date = "{$request->year}-{$request->month}";
            $id = $request->id;
            $title = $request->title;
        }

        // 指定された日付とIDに基づいてカレンダーのHTMLデータを取得します
        $calendar = $this->show($date, $id);

        // カレンダーデータ、カレンダーのHTML、タイトル、IDをビューに渡します
        return view('calendar.index', compact('calendars', 'calendar', 'title', 'id'));
    }

    //カレンダーを生成するメソッド

    public function show($date,$id){

        $calendar = null;

		if($date){
            $calendar = new CalendarView($date,$id);
        }
        return $calendar;
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
        //バリデーション = 妥当性の確認
        $request->validate([
            //タイトル文字上限255文字
            'editTitle' => 'required|max:255',
        ]);

        $id = $request->id;
        $editTitle = $request->editTitle;
        return view('calendar.edit', compact('editTitle','id'));
    }

    /**
     *  Calendarタイトル変更
     */

    public function update(Request $request)
    {
        //バリデーション = 妥当性の確認
        $request->validate([
            //タイトル文字上限255文字
            'title' => 'required|max:255',
            'id' => 'required'
        ]);

        //タイトルを変更し、更新する。(UPDATE)
        $calendar = Calendar::find($request->id);
        $calendar->update([
            'title' => $request->title
        ]);

        //リダイレクト
        return redirect()->route('calendar.index');
    }

    /**
     *  Calendar削除画面遷移
     */
    public function delete_request(Request $request)
    {
        //バリデーション = 妥当性の確認
        $request->validate([
            //id必須
            'id' => 'required'
        ]);
        $calendar = Calendar::find($request->id);
        //リダイレクト
        return view('calendar.delete_request',compact('calendar'));
    }

    /**
     * Calendar削除
     */

     public function delete_confirm(Request $request)
     {
        $calendar = Calendar::find($request->id);
        $calendar->delete();

        return redirect()->route('calendar.index');
     }

     /**
      * //カレンダーリストの並び替えを保存する
      */

    // カレンダーのorder_numカラムの値を更新するメソッド
    public function update_list(Request $request)
    {
        //コントローラーから順序を保持したid配列を受け取る
        $data_ids = $request->data_ids;

        //配列順にレコードを取り出して、順番の番号を代入する
        for($i=0; $i<count($data_ids); $i++) {
            $calendar = Calendar::where('id','=',$data_ids[$i])->first();
            $calendar->order_num = $i+1;
            $calendar->save();
        }
        // レスポンスを返す
        return response('並び替えを更新しました！');
    }

}
