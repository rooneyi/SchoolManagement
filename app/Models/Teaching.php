<?php

namespace App\Models;

use App\Models\Concerns\BelongsToSchool;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teaching extends Model
{
    use HasFactory, BelongsToSchool;

    protected $fillable = [
        'school_id',
        'classroom_id',
        'subject_id',
        'employee_id',
        'total_hours',
        'credits',
    ];

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}

