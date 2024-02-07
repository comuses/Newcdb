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
        Schema::table('retains', function (Blueprint $table) {
            $table
                ->foreign('case1_id')
                ->references('id')
                ->on('case1s')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('attorney_id')
                ->references('id')
                ->on('attorneys')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('retains', function (Blueprint $table) {
            $table->dropForeign(['case1_id']);
            $table->dropForeign(['attorney_id']);
            $table->dropForeign(['employee_id']);
        });
    }
};
