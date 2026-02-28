<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'student_id',
        'guardian_id',
        'school_id',
        'year_id',
        'classroom_id',
        'section_id',
        'registration_date',
        'status',
    ];
}
