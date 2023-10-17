<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueConstraintToMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // memosテーブルのcalendar_idとdateの組み合わせに一意性制約を追加する
        Schema::table('memos', function (Blueprint $table) {
            $table->unique(['calendar_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // memosテーブルのcalendar_idとdateの組み合わせの一意性制約を削除する
        Schema::table('memos', function (Blueprint $table) {
            $table->dropUnique(['calendar_id', 'date']);
        });
    }
}
