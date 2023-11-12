import './bootstrap';
import jQuery from 'jquery';
window.$ = jQuery;
import Sortable from 'sortablejs';

//【カレンダーリストをドラッグ＆ドロップで並び替える。】

var calendarList = document.getElementById('calendarList');
var sortable1 = Sortable.create(calendarList,{
    animation:150,
});


//【カレンダーメモの変更を検知してデータを更新する。】

const inputs = document.querySelectorAll("textarea");

inputs.forEach(input =>{
    input.addEventListener("change", updateValue);
});

//この関数で、カレンダーid、日付、メモ内容を送信する。
function updateValue(e) {
    //カレンダーidが格納されているタグを取得
    const a = document.getElementById("calendar_id");

    //カレンダーid◎ メモを取得◎ 日付取得◎
    const calendar_id = a.dataset.id;
    const date = e.target.nextElementSibling.value;
    const memo = e.target.value;

    // 取得した値をダイアログボックスにテスト表示
    //alert("date: " + date + " memo: " + memo + " id: " + calendar_id);

// ajaxSetupメソッドでCSRFトークンをヘッダーに付与する
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

// jQueryのajaxメソッドでコントローラーにPOSTリクエストを送る
$.ajax({
  type: "POST",
  url: "/memo/upsert_memo", // コントローラーのURL
  data: JSON.stringify({
    // 送信する変数
    calendar_id: calendar_id,
    date: date,
    memo: memo
  }),
  dataType: "json", // レスポンスのデータ形式
  contentType: "application/json" //リクエストのデータ形式
}).done(function (data) {
  // 通信が成功したときの処理

  //alert(data['message']); //テスト用
}).fail(function (error) {
  // 通信が失敗したときの処理

  //alert('ajax失敗'); //テスト用
});


}
