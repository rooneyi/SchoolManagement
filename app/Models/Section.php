<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory, \App\Models\Concerns\BelongsToSchool;

    protected $fillable = [
        'name',
        'school_id',
        'code',
        'education_level',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function classrooms(): HasMany
    {
        return $this->hasMany(Classroom::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function getEducationLevelLabelAttribute(): string
    {
        return match($this->education_level) {
            'preschool' => 'Maternelle',
            'primary' => 'Primaire',
            'secondary' => 'Secondaire',
            'university' => 'Supérieur',
            'vocational' => 'Professionnel',
            default => 'Autre',
        };
    }
}
