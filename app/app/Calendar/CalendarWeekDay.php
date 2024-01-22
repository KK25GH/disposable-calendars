<?php
namespace App\Calendar;

use App\Models\Memo;
use Carbon\Carbon;
use Yasumi\Yasumi;

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
        //祝日の英語名をキー、日本語名を値として格納する配列
        $HolidayNameJP = array(
            "newYearsDay" => "元日",
            "comingOfAgeDay" => "成人の日",
            "nationalFoundationDay" => "建国記念の日",
            "showaDay" => "昭和の日",
            "constitutionMemorialDay" => "憲法記念日",
            "greeneryDay" => "みどりの日",
            "childrensDay" => "こどもの日",
            "marineDay" => "海の日",
            "mountainDay" => "山の日",
            "respectfortheAgedDay" => "敬老の日",
            "sportsDay" => "体育の日",
            "cultureDay" => "文化の日",
            "laborThanksgivingDay" => "勤労感謝の日",
            "emperorsBirthday" => "天皇誕生日",
            "vernalEquinoxDay" => "春分の日",
            "autumnalEquinoxDay" => "秋分の日",
            "substituteHoliday:newYearsDay" => "振替休日",
            "substituteHoliday:comingOfAgeDay" => "振替休日",
            "substituteHoliday:nationalFoundationDay" => "振替休日",
            "substituteHoliday:showaDay" => "振替休日",
            "substituteHoliday:constitutionMemorialDay" => "振替休日",
            "substituteHoliday:greeneryDay" => "振替休日",
            "substituteHoliday:childrensDay" => "振替休日",
            "substituteHoliday:marineDay" => "振替休日",
            "substituteHoliday:mountainDay" => "振替休日",
            "substituteHoliday:respectfortheAgedDay" => "振替休日",
            "substituteHoliday:sportsDay" => "振替休日",
            "substituteHoliday:cultureDay" => "振替休日",
            "substituteHoliday:laborThanksgivingDay" => "振替休日",
            "substituteHoliday:emperorsBirthday" => "振替休日",
            "substituteHoliday:vernalEquinoxDay" => "振替休日",
            "substituteHoliday:autumnalEquinoxDay" => "振替休日"
        );

        $memo = Memo::where('calendar_id', $this->id)->where('date', $this->carbon->format('j'))->first();
        // 日本の作成時における年間の祝日を取得する
        $holidays = Yasumi::create('Japan', $this->carbon->format('Y'),'ja_JP');

        //祝日か判断する日付を変数に代入する
        $date = $this->carbon->format('Y-m-d');
        //曜日を取得する(日曜日を０からカウントする)
        $dayOfWeek = $this->carbon->dayOfWeek;

        //祝日の英語名とその日付が格納された配列を取得する
        $holidayArray = $holidays->getHolidayDates();
        //empty()の場合、空白とnullを検知する。isset()はnullのみ
        //$holidayArrayの中に、$dateの日付が存在するかを確認する。
        if(empty($memo) && in_array($date, $holidayArray)) {
            //メモがなく、祝日である。

            //配列から特定の日付の英語名を獲得する。
            $holidayNameEN = array_search($date,$holidayArray);

            return "<div class='day'>{$this->carbon->format('j')}<div class='holidayName'>{$HolidayNameJP[$holidayNameEN]}</div></div>
            <textarea class='memo'></textarea>
            <input type='hidden' id='day-{$this->carbon->format('j')}' value='{$this->carbon->format('j')}'>";
        } else if(empty($memo) && !(in_array($date, $holidayArray))) {
            //メモがなく、祝日でない。
            return "<p class='day'>{$this->carbon->format('j')}</p>
            <textarea class='memo'></textarea>
            <input type='hidden' id='day-{$this->carbon->format('j')}' value='{$this->carbon->format('j')}'>";
        } else if(in_array($date, $holidayArray)) {
            //メモがあり、祝日である。
            $holidayNameEN = array_search($date,$holidayArray);

            return "<div class='day'>{$this->carbon->format('j')}<div class='holidayName'>{$HolidayNameJP[$holidayNameEN]}</div></div>
            <textarea class='memo'>{$memo->memo}</textarea>
            <input type='hidden' id='day-{$this->carbon->format('j')}' value='{$this->carbon->format('j')}'>";
        } else {
            //メモがあり、祝日でない。
            return "<p class='day'>{$this->carbon->format('j')}</p>
            <textarea class='memo'>{$memo->memo}</textarea>
            <input type='hidden' id='day-{$this->carbon->format('j')}' value='{$this->carbon->format('j')}'>";
        }
	}
}
