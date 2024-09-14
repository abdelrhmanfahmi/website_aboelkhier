<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetTranslator extends Model
{
    use HasFactory;
    protected $fillable = ['reset_id' , 'translator_id'];

    public function recieve_resets()
    {
        return $this->belongsTo(Reset::class , 'reset_id');
    }

    public function translators()
    {
        return $this->belongsTo(Translator::class , 'translator_id');
    }
}
