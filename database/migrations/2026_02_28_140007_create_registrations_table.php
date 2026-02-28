<?php

use App\Models\Classroom;
use App\Models\School;
use App\Models\Section;
use App\Models\Year;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->foreignId('guardian_id');
            $table->foreignIdFor(School::class);
            $table->foreignIdFor(Year::class);
            $table->foreignIdFor(Classroom::class);
            $table->foreignIdFor(Section::class);
            $table->date('registration_date');
            $table->string('status', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
