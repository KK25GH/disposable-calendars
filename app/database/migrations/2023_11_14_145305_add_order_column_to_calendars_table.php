<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderColumnToCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // calendarsテーブルにorder_numカラムを追加
        Schema::table('calendars', function (Blueprint $table) {

            // idカラムの後にorder_numカラムを追加
            $table->unsignedBigInteger('order_num')->default(0)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // calendarsテーブルからorder_numカラムを削除
        Schema::table('calendars', function (Blueprint $table) {
            $table->dropColumn('order_num');
        });
    }
}
