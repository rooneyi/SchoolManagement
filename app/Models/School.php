<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::addGlobalScope('per-user-school', function (Builder $builder): void {
            if (app()->runningInConsole()) {
                return;
            }

            $user = auth()->user();

            if ($user && method_exists($user, 'isSystemAdmin') && $user->isSystemAdmin()) {
                return;
            }

            if (! $user || ! $user->school_id) {
                $builder->whereRaw('1 = 0');
                return;
            }

            $builder->where($builder->getModel()->getTable() . '.id', $user->school_id);
        });
    }

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'months_count',
        'monthly_amount',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function classrooms(): HasMany
    {
        return $this->hasMany(Classroom::class);
    }

    public function years(): HasMany
    {
        return $this->hasMany(Year::class);
    }

    public function guardians(): HasMany
    {
        return $this->hasMany(Guardian::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }
}
