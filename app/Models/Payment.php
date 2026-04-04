<?php

namespace App\Models;

use App\Models\Concerns\BelongsToSchool;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Payment extends Model
{
    use HasFactory, BelongsToSchool;

    protected $fillable = [
        'fee_id',
        'payment_method',
        'amount',
        'paid_at',
        'reference',
        'notes',
    ];

    protected static function booted(): void
    {
        static::creating(function (Payment $payment): void {
            if (empty($payment->reference)) {
                $payment->reference = 'PAY-'.Str::upper(Str::random(10));
            }
        });

        static::created(function (Payment $payment): void {
            $payment->fee?->refreshStatus();
        });

        static::deleted(function (Payment $payment): void {
            $payment->fee?->refreshStatus();
        });
    }

    public function fee(): BelongsTo
    {
        return $this->belongsTo(Fee::class);
    }
}
