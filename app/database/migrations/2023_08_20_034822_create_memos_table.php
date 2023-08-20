<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Calendar;

class CreateMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // メモのデータベースを作成
        Schema::create('memos', function (Blueprint $table) {
            $table->id(); // idカラム
            $table->foreignId('calendar_id') // calendar_idカラム（外部キー）
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->date('date'); // dateカラム
            $table->text('memo'); // memoカラム
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
        Schema::dropIfExists('memos');
    }
}
