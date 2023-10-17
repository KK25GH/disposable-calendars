<?php
namespace App\Calendar;

use Carbon\Carbon;

class CalendarView {

	private $carbon;
    private $id;

	function __construct($date,$id){
		$this->carbon = new Carbon($date);
        $this->id = $id;
	}
	/**
	 * タイトル
	 */
	public function getTitle(){
		return $this->carbon->format('Y年n月');
	}

	/**
	 * カレンダーを出力する
	 */
	function render(){
		$html = [];
		$html[] = '<div class="calendar">';
		$html[] = '<table class="table">';
		$html[] = '<thead>';
		$html[] = '<tr>';
		$html[] = '<th>月</th>';
		$html[] = '<th>火</th>';
		$html[] = '<th>水</th>';
		$html[] = '<th>木</th>';
		$html[] = '<th>金</th>';
		$html[] = '<th>土</th>';
        $html[] = '<th>日</th>';
		$html[] = '</tr>';
		$html[] = '</thead>';

        $html[] = '<tdbody>'; //開始タグ 行のグループ化 １か月分すべて

        $weeks = $this->getWeeks();
        foreach($weeks as $week){
            $html[] = '<tr class="'.$week->getClassName().'">';
            $days = $week->getDays();
            foreach($days as $day){
                $html[] = '<td class="'.$day->getClassName().'">';
                $html[] = $day->render();
                $html[] = '</td>';
            }
            $html[] = '</tr>';
        }

        $html[] = '</tbody>'; //終了タグ 行のグループ化

		$html[] = '</table>';
		$html[] = '</div>';
		return implode("", $html);
	}

    /**
     * 週の情報を取得するためのgetWeeks()関数を作成する
     */

     protected function getWeeks(){
		$weeks = [];

		//初日
		$firstDay = $this->carbon->copy()->firstOfMonth();

		//月末まで
		$lastDay = $this->carbon->copy()->lastOfMonth();

		//1週目
		$week = new CalendarWeek($firstDay->copy(),count($weeks),$this->id);
		$weeks[] = $week;

        /**
         * 補足：$firstDayを+7日すると、来週のその曜日に移行できる。
         * 仮に$firstDayが火曜日だとすると＋７日しても火曜日
         * ここで、startOfWeek()を使って、週の初め月曜日（デフォルト）を取得
         */
		//作業用の日
		$tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();

        /**
         * 補足：lte()とは、（<=)以下を表す。tmpDayがlatDay以下の間のループ
         */
		//月末までループさせる
		while($tmpDay->lte($lastDay)){
			//週カレンダーViewを作成する
			$week = new CalendarWeek($tmpDay, count($weeks),$this->id);
			$weeks[] = $week;

            //次の週=+7日する
			$tmpDay->addDay(7);
		}

		return $weeks;
	}
}
