<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopyResetFile extends Model
{
    use HasFactory;
    protected $fillable = ['reset_file_copy_name' , 'number_copies' , 'reset_id'];

    public function recieved_resets()
    {
        return $this->belongsTo(Reset::class , 'reset_id');
    }
}
