<?php

use App\Models\Guardian;
use App\Models\School;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('matricule', 50)->unique();
            $table->string('name');
            $table->string('post_name');
            $table->string('email')->unique();
            $table->string('phone', 20)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('address')->nullable();
            $table->string('photo')->nullable();
            $table->string('bulletin_file')->nullable();
            $table->foreignIdFor(School::class);
            $table->foreignIdFor(Guardian::class);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
