<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Classroom extends Model
{
    protected $fillable = [
        'name',
        'code',
        'capacity',
        'section_id',
    ];

    public function sections(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
