import './bootstrap';
import jQuery from 'jquery';
window.$ = jQuery;

const inputs = document.querySelectorAll("textarea");

inputs.forEach(input =>{
    input.addEventListener("input", updateValue);
});

//この関数で、カレンダーid、日付、メモ内容を送信する。
function updateValue(e) {
    //カレンダーidが格納されているタグを取得
    const a = document.getElementById("calendar_id");

    //カレンダーid◎ メモを取得◎ 日付取得◎
    const calendar_id = a.dataset.id;
    const date = e.target.nextElementSibling.value;
    const memo = e.target.value;

    // 取得した値をダイアログボックスに表示
    //alert("date: " + date + " memo: " + memo + " id: " + calendar_id);

    // jQueryのajaxメソッドでコントローラーにPOSTリクエストを送る
  $.ajax({
    type: "POST",
    url: "/calendar/upsert_memo", // コントローラーのURL
    data: { // 送信する変数
      calendar_id: calendar_id,
      date: date,
      memo: memo
    },
    dataType: "json" // レスポンスのデータ形式
  }).done(function (data) {
    // 通信が成功したときの処理
    alert.log(data);
  }).fail(function (error) {
    // 通信が失敗したときの処理
    alert.error(error);
  });
}

