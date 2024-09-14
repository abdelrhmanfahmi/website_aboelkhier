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
        Schema::create('resets', function (Blueprint $table) {
            $table->id();
            $table->dateTime('reset_date');
            $table->string('reset_client');
            $table->string('client_code')->nullable();
            $table->string('reset_client_phone');
            $table->string('reset_client_phone_second')->nullable();
            $table->enum('reset_translation' , ['طبي' , 'غير معتمدة' , 'معتمدة']);
            $table->string('reset_where');
            $table->text('reset_for');
            $table->unsignedInteger('reset_pages_number');
            $table->string('reset_name_english')->nullable();
            $table->unsignedDouble('reset_total_cost');
            $table->unsignedDouble('reset_cost_paid')->nullable();
            $table->unsignedDouble('reset_cost_not_paid')->nullable();
            $table->dateTime('reset_recieved_date');
            $table->text('reset_notes')->nullable();
            $table->text('reset_notes_client')->nullable();
            $table->string('payment_type');
            $table->string('payment_type_two')->nullable();
            $table->unsignedInteger('language_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('edit_user_id')->nullable();
            $table->json('translators')->nullable();
            $table->text('translator_notes')->nullable();
            $table->enum('is_scan' , [0,1])->default(0)->nullable();
            $table->string('scan_price')->nullable();
            $table->string('scan_payment_type')->nullable();
            $table->enum('has_delivered' , [0,1])->default(0)->nullable();
            $table->string('deliver_price')->nullable();
            $table->string('deliver_payment_type')->nullable();
            $table->enum('has_discount' , [0,1])->default(0)->nullable();
            $table->string('discount_price')->nullable();
            $table->string('discount_desc')->nullable();
            $table->enum('is_revised',[0,1,2,3])->default(0)->nullable();
            $table->text('revert_reason')->nullable();
            $table->unsignedInteger('revised_by')->nullable();
            $table->enum('recieved_by' , [0,1])->nullable();
            $table->string('recieved_by_name')->nullable();
            $table->string('recieved_by_phone')->nullable();
            $table->enum('is_draft' , [0,1])->default(0)->nullable();
            $table->enum('is_full_cost' , [0,1])->nullable();
            $table->dateTime('date_full_payed')->nullable();
            $table->enum('money_status' , [0,1])->nullable();
            $table->enum('is_payed' , [0,1])->nullable();
            $table->unsignedDouble('change_reset')->nullable();
            $table->enum('is_company' , [0,1])->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resets');
    }
};
