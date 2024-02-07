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
        Schema::create('retains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('attorneyID');
            $table->string('caseID');
            $table->string('emplooyID');
            $table->date('date');
            $table->unsignedBigInteger('case1_id');
            $table->unsignedBigInteger('attorney_id');
            $table->unsignedBigInteger('employee_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retains');
    }
};
