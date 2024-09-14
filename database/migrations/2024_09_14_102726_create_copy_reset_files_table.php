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
        Schema::create('copy_reset_files', function (Blueprint $table) {
            $table->id();
            $table->string('reset_file_copy_name');
            $table->integer('number_copies');
            $table->unsignedInteger('reset_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copy_reset_files');
    }
};
