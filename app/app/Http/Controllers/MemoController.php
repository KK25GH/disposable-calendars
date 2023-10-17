<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use Illuminate\Support\Facades\Auth;

class MemoController extends Controller
{
    /**
     * ログインしているかを確認する。
     * している場合は、MemoControllerへアクセスできる。
     * していない場合は、ログインすることを要求する。
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
      * Calendarメモ挿入と更新
      */

      public function upsert_memo(Request $request)
      {
        // JavaScriptから送られた変数を受け取る
        $calendar_id = $request->input('calendar_id');
        $date = $request->input('date');
        $memo = $request->input('memo');

        if(empty($memo)) {
            //メモが空白のとき、データを削除する。
            Memo::where('calendar_id', $calendar_id)->where('date', $date)->delete();
        } else {
            // upsertメソッドでデータを更新または追加する
            Memo::upsert(
                [
                    ['calendar_id' => $calendar_id, 'date' => $date, 'memo' => $memo]
                ],
                ['calendar_id', 'date'],
                ['memo']
                );
        }

        // レスポンスを返す
        return response()->json(['message' => 'Success']);
      }
}
