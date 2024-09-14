<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reset extends Model
{
    use HasFactory;
    protected $fillable = [
        'reset_date',
        'reset_client',
        'reset_client_phone',
        'reset_client_phone_second',
        'client_code',
        'reset_translation',
        'reset_where',
        'reset_for',
        'reset_pages_number',
        'reset_name_english',
        'reset_total_cost',
        'reset_cost_paid',
        'reset_cost_not_paid',
        'reset_recieved_date',
        'reset_notes',
        'reset_notes_client',
        'payment_type',
        'payment_type_two',
        'language_id',
        'user_id',
        'edit_user_id',
        'translators',
        'translator_notes',
        'is_scan',
        'scan_price',
        'scan_payment_type',
        'has_delivered',
        'deliver_price',
        'deliver_payment_type',
        'has_discount',
        'discount_price',
        'discount_desc',
        'is_revised',
        'revert_reason',
        'revised_by',
        'recieved_by',
        'recieved_by_name',
        'recieved_by_phone',
        'is_draft',
        'is_full_cost',
        'date_full_payed',
        'money_status',
        'is_payed',
        'change_reset',
        'is_company'
    ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class , 'language_id');
    }

    public function files_recieved_resets()
    {
        return $this->HasMany(FileRecievedReset::class);
    }

    public function reset_file_names()
    {
        return $this->HasMany(ResetFileName::class);
    }

    public function copy_reset_files()
    {
        return $this->HasMany(CopyResetFile::class);
    }

    public function recieve_resets_translators(){
        return $this->hasMany(ResetTranslator::class);
    }
}
