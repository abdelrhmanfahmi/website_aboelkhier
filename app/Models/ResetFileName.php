<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetFileName extends Model
{
    use HasFactory;
    protected $fillable = ['reset_file_name' , 'reset_file_original' , 'reset_id'];

    public function recieved_resets()
    {
        return $this->belongsTo(Reset::class , 'reset_id');
    }
}
