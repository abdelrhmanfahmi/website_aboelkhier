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
        Schema::create('reset_file_names', function (Blueprint $table) {
            $table->id();
            $table->string('reset_file_name');
            $table->enum('reset_file_original' , [0,1])->default(0);
            $table->unsignedInteger('reset_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reset_file_names');
    }
};
