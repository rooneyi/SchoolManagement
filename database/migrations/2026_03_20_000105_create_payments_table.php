<?php

use App\Models\Fee;
use App\Models\School;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Fee::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(School::class);
            $table->string('payment_method', 50);
            $table->decimal('amount', 12, 2);
            $table->timestamp('paid_at')->useCurrent();
            $table->string('reference', 50)->unique();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['school_id', 'fee_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
