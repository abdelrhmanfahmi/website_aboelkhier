<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $fillable = ['first_language' , 'second_language' , 'price'];

    public function recieved_resets()
    {
        // return $this->hasMany(RecieveReset::class);
    }
}
