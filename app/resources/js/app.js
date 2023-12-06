import './bootstrap';
import jQuery from 'jquery';
window.$ = jQuery;
import Sortable from 'sortablejs';

//holidayNameクラスを持つタグの親要素にholidayクラスを適用する (JQuery)
$("td:has(.holidayName)").addClass("holiday");

//【カレンダーリストをドラッグ＆ドロップで並び替える】

// div要素を取得
var calendarList = document.getElementById('calendarList');
// SortableJSを適用
var sortable = new Sortable(calendarList, {
    animation:150,
  // 並び替えが完了したときのイベント
  onEnd: function (evt) {
    var data_ids = []; // データidを格納する配列
    var elements = document.querySelectorAll("a.list-group-item p[data-id]"); // aタグのクラスがlist-group-itemで、pタグにdata-id属性がある要素を取得
    for (var i = 0; i < elements.length; i++) { // 要素をループ
      var data_id = elements[i].dataset.id; // data-id属性の値を取得
      data_ids.push(data_id); // 配列に追加
    }
    console.log(data_ids); // 配列をコンソールに出力

    updateOrderNum(data_ids);
  }
});

// 並び替えられた要素のorder_numカラムの値を更新する関数
function updateOrderNum(data_ids) {
    // ajaxSetupメソッドでCSRFトークンをヘッダーに付与する
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Ajaxでサーバーにリクエストを送る
    $.ajax({
        type: "POST",
        url: "calendar/update_list", // コントローラーのURL
        data: {
        // 送信する配列
        data_ids: data_ids
        }
    }).done(function (response) {
        // 通信が成功したときの処理
        //console.log(response);
    }).fail(function(jqXHR, textStatus, errorThrown) {
        // 通信が失敗したときの処理

        alert("並び替えの保存に失敗しました。");
        //alert(textStatus + ": " + jqXHR.status + ":" + errorThrown);
    });
}



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

  alert('メモの保存に失敗しました。');
});


}
