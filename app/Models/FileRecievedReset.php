<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileRecievedReset extends Model
{
    use HasFactory;
    protected $fillable = ['file' , 'reset_id'];

    public function recieved_resets()
    {
        return $this->belongsTo(Reset::class , 'reset_id');
    }
}
