<?php
namespace App\Calendar;

use App\Models\Memo;
use Carbon\Carbon;



class CalendarWeekDay {
	protected $carbon;
    protected $id;

	function __construct($date,$id){
		$this->carbon = new Carbon($date);
        $this->id = $id;
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
        $memo = Memo::where('calendar_id', $this->id)->where('date', $this->carbon->format('j'))->first();

        //empty()の場合、空白とnullを検知する。isset()はnullのみ
        if(empty($memo)) {
            return "<p class='day'>{$this->carbon->format('j')}</p>
            <textarea class='memo'></textarea>
            <input type='hidden' id='day-{$this->carbon->format('j')}' value='{$this->carbon->format('j')}'>";
        } else {
            return "<p class='day'>{$this->carbon->format('j')}</p>
            <textarea class='memo'>{$memo->memo}</textarea>
            <input type='hidden' id='day-{$this->carbon->format('j')}' value='{$this->carbon->format('j')}'>";
        }
	}
}
