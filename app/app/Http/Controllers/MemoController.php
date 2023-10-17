<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemoController extends Controller
{
     /**
      * Calendarメモ挿入と更新
      */

      public function upsert_memo(Request $request)
      {
        // JavaScriptから送られた変数を受け取る
        $calendar_id = $request->input('calendar_id');
        $date = $request->input('date');
        $memo = $request->input('memo');

        // upsertメソッドでデータを更新または追加する
        Memo::upsert(
        [
            ['calendar_id' => $calendar_id, 'date' => $date, 'memo' => $memo]
        ],
        ['calendar_id', 'date'],
        ['memo']
        );

        // レスポンスを返す
        return response()->json(['message' => 'Success']);
      }
}
