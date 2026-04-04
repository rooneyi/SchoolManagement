<?php

use App\Models\Classroom;
use App\Models\Employee;
use App\Models\School;
use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(School::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Classroom::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Subject::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Employee::class)->nullable()->constrained()->nullOnDelete();

            // Pour le supérieur : volume horaire global ou crédits
            $table->integer('total_hours')->nullable()->comment('Volume horaire global pour le supérieur');
            $table->integer('credits')->nullable()->comment('Crédits pour le supérieur');

            $table->timestamps();

            // Un prof ne peut enseigner la même matière dans la même classe qu'une seule fois (unicité de l'attribution)
            // Sauf si on veut gérer plusieurs profs pour une même matière (co-intervention), auquel cas on retire l'index unique.
            // Restons simple pour l'instant.
            $table->unique(['classroom_id', 'subject_id', 'employee_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachings');
    }
};

