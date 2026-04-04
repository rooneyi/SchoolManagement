<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Adds per-school scoping and guards school_id mutation for tenant data.
 */
trait BelongsToSchool
{
    public static function bootBelongsToSchool(): void
    {
        static::addGlobalScope('school', function (Builder $builder): void {
            if (app()->runningInConsole()) {
                return;
            }

            $user = auth()->user();

            if (! $user || ! $user->school_id) {
                $builder->whereRaw('1 = 0');
                return;
            }

            $builder->where($builder->getModel()->getTable() . '.school_id', $user->school_id);
        });

        static::creating(function (Model $model): void {
            $user = auth()->user();

            if ($user && $user->school_id && empty($model->school_id)) {
                $model->school_id = $user->school_id;
            }
        });

        static::updating(function (Model $model): void {
            if ($model->isDirty('school_id')) {
                $model->school_id = $model->getOriginal('school_id');
            }
        });
    }

    public function scopeForCurrentSchool(Builder $query): Builder
    {
        $user = auth()->user();


        if (! $user || ! $user->school_id) {
            return $query->whereRaw('1 = 0');
        }

        return $query->withoutGlobalScope('school')
            ->where($query->getModel()->getTable() . '.school_id', $user->school_id);
    }
}
