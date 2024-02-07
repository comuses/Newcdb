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
        Schema::create('case1s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('partyID');
            $table->string('Action');
            $table->string('courtID');
            $table->string('attorneyID');
            $table->string('judgeID');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('caseTyep');
            $table->string('caseStatus');
            $table->string('emplooyID');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case1s');
    }
};
