<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTranslator extends Model
{
    use HasFactory;
    protected $fillable = ['email' , 'phone' , 'translator_id'];

    public function translator()
    {
        return $this->belongsTo(Translator::class , 'translator_id');
    }
}
