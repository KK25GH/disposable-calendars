<?php
namespace App\Calendar;

use Carbon\Carbon;

class CalendarWeek {

	protected $carbon;
    protected $id;
	protected $index = 0;

	function __construct($date, $index=0, $id){
		$this->carbon = new Carbon($date);
		$this->index = $index;
        $this->id = $id;
	}

	function getClassName(){
		return "week-" . $this->index;
	}

	/**
	 * @return CalendarWeekDay[]
	 */
	function getDays(){

		$days = [];

		//開始日〜終了日
		$startDay = $this->carbon->copy()->startOfWeek();
		$lastDay = $this->carbon->copy()->endOfWeek();

		//作業用
		$tmpDay = $startDay->copy();

		//月曜日〜日曜日までループ
		while($tmpDay->lte($lastDay)){
            /**
             * 補足:月～日を回しているときに月が変わったら空白にする処理
             */
			//前の月、もしくは後ろの月の場合は空白を表示
			if($tmpDay->month != $this->carbon->month){
				$day = new CalendarWeekBlankDay($tmpDay->copy(),$this->id);
				$days[] = $day;
				$tmpDay->addDay(1);
				continue;
			}

			//今月
			$day = new CalendarWeekDay($tmpDay->copy(),$this->id);
			$days[] = $day;
			//翌日に移動
			$tmpDay->addDay(1);
		}

		return $days;
	}
}
