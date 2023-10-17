<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // dateカラムの型をintに変更
        DB::statement('ALTER TABLE memos ALTER date TYPE integer USING to_char(date, \'YYYY-MM-DD\')::integer');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // dateカラムの型をdateに戻す
        DB::statement('ALTER TABLE memos ALTER date TYPE date USING to_char(date, \'YYYY-MM-DD\')');
    }
};
