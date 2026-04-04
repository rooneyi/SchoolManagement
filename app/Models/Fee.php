<?php

namespace App\Models;

use App\Models\Concerns\BelongsToSchool;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fee extends Model
{
    use HasFactory, BelongsToSchool;

    protected $fillable = [
        'registration_id',
        'school_id',
        'title',
        'type',
        'amount_due',
        'currency',
        'status',
        'due_date',
        'notes',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function refreshStatus(): void
    {
        $paid = (float) $this->payments()->sum('amount');

        $newStatus = 'unpaid';
        if ($paid >= (float) $this->amount_due && $paid > 0) {
            $newStatus = 'paid';
        } elseif ($paid > 0) {
            $newStatus = 'partial';
        }

        if ($this->status !== $newStatus) {
            $this->forceFill(['status' => $newStatus])->saveQuietly();
        }
    }
}
