<?php

use App\Models\Registration;
use App\Models\School;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Registration::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(School::class);
            $table->decimal('amount_due', 12, 2);
            $table->string('currency', 8)->default('XAF');
            $table->string('status', 20)->default('unpaid');
            $table->date('due_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['school_id', 'registration_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
