<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    //
    protected $fillable = [
        'school_id',
        'name',
        'is_active',
        'start_date',
        'end_date',
    ];
}
