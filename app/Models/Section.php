<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Section extends Model
{
    protected $fillable = [
        'name',
        'school_id',
        'code',
    ];

    public function schools(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
