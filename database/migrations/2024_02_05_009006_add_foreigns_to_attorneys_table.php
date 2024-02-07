<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('attorneys', function (Blueprint $table) {
            $table
                ->foreign('case1_id')
                ->references('id')
                ->on('case1s')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attorneys', function (Blueprint $table) {
            $table->dropForeign(['case1_id']);
        });
    }
};
