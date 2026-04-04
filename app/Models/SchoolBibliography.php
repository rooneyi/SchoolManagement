<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolBibliography extends Model
{
    /** @use HasFactory<\Database\Factories\SchoolBibliographyFactory> */
    use HasFactory;

    protected $fillable = [
        'school_id',
        'title',
        'author',
        'year',
        'type',
        'description',
        'url',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
