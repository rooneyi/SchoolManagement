<?php

use App\Models\Classroom;
use App\Models\Employee;
use App\Models\School;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Adapter les sections pour le niveau d'étude
        Schema::table('sections', function (Blueprint $table) {
            $table->enum('education_level', ['preschool', 'primary', 'secondary', 'university', 'vocational'])
                  ->default('secondary')
                  ->after('name')
                  ->comment('Niveau d\'enseignement pour adapter l\'affichage');
        });

        // 2. Table des matières (Cours/Activités)
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(School::class)->constrained()->cascadeOnDelete();
            $table->string('name'); // Math, Français, Sieste...
            $table->string('code')->nullable(); // MATH101
            $table->string('color')->default('#3b82f6'); // Pour l'affichage dans l'emploi du temps
            $table->timestamps();
        });

        // 3. Table des horaires de cours
        Schema::create('course_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(School::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Classroom::class)->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->nullOnDelete(); // Le prof

            $table->integer('day_of_week'); // 1 = Lundi, 7 = Dimanche
            $table->time('start_time');
            $table->time('end_time');

            $table->string('room')->nullable(); // Salle spécifique si différente de la classe
            $table->timestamps();

            $table->index(['school_id', 'classroom_id']);
            $table->index(['school_id', 'employee_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_schedules');
        Schema::dropIfExists('subjects');
        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn('education_level');
        });
    }
};

