<?php

namespace App\Models;

use App\Models\Concerns\BelongsToSchool;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasFactory, BelongsToSchool;

    protected $fillable = [
        'school_id',
        'user_id',
        'first_name',
        'last_name',
        'photo_path',
        'email',
        'phone',
        'address',
        'city',
        'job_title',
        'salary',
        'hiring_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'hiring_date' => 'date',
        'salary' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getInitialsAttribute(): string
    {
        return Str::upper(Str::substr($this->first_name, 0, 1) . Str::substr($this->last_name, 0, 1));
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}
