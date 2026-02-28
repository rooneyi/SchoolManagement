<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public function school(): belongsTo
    {
        return $this->belongsTo(School::class);
    }
}
