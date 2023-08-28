<?php
namespace App\Calendar;
use Carbon\Carbon;

class CalendarWeekDay {
	protected $carbon;

	function __construct($date){
		$this->carbon = new Carbon($date);
	}

    /**
     * 補足:strtolowerとは？ PHPの大文字を小文字変換する関数
     *      format("D")とは？ 曜日を省略形式で取得 → sun mon
     */
	function getClassName(){
		return "day-" . strtolower($this->carbon->format("D"));
	}

	/**
	 * @return
     *
     * 補足：format("j")とは？ 先頭に０をつけない日付  01:x -> 1:o
	 */
	function render(){
		return '<p class="day">' . $this->carbon->format("j"). '</p>';
	}
}
