<?php

use App\Models\School;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(School::class)->constrained()->cascadeOnDelete();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();

            $table->string('job_title')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->date('hiring_date')->nullable();

            $table->string('status')->default('active'); // active, inactive, suspended

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['school_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

