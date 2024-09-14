<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translator extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function email_translators()
    {
        return $this->hasMany(EmailTranslator::class);
    }

    // public function recieve_resets_translators(){
    //     return $this->hasMany(RecievedTranslator::class);
    // }
}
