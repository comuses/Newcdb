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
        Schema::create('bars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('attorneyID');
            $table->string('bar');
            $table->unsignedBigInteger('attorney_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bars');
    }
};
