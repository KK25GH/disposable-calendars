<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // カレンダーのデータベースを作成
        Schema::create('calendars', function (Blueprint $table) {
            $table->id(); // idカラム
            $table->foreignId('user_id') // 外部キーを追加
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('name'); // nameカラム
            $table->integer('year'); // yearカラム
            $table->integer('month'); // monthカラム
            $table->timestamps(); // created_atとupdated_atカラム
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // データベースを削除
        Schema::dropIfExists('calendars');
    }
}
