<?php

namespace Tests\Feature;

use App\Models\Classroom;
use App\Models\Guardian;
use App\Models\Registration;
use App\Models\School;
use App\Models\Section;
use App\Models\Student;
use App\Models\Year;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationControllerTest extends TestCase
{
    use RefreshDatabase;

    private School $school;

    private Guardian $guardian;

    private Student $student;

    private Year $year;

    private Section $section;

    private Classroom $classroom;

    private Registration $registration;

    protected function setUp(): void
    {
        parent::setUp();
        $this->school = School::factory()->create();
        $this->guardian = Guardian::factory()->create(['school_id' => $this->school->id]);
        $this->student = Student::factory()->create([
            'school_id' => $this->school->id,
            'guardian_id' => $this->guardian->id,
        ]);
        $this->year = Year::factory()->create(['school_id' => $this->school->id]);
        $this->section = Section::factory()->create(['school_id' => $this->school->id]);
        $this->classroom = Classroom::factory()->create([
            'school_id' => $this->school->id,
            'section_id' => $this->section->id,
        ]);
        $this->registration = Registration::factory()->create([
            'student_id' => $this->student->id,
            'guardian_id' => $this->guardian->id,
            'school_id' => $this->school->id,
            'year_id' => $this->year->id,
            'classroom_id' => $this->classroom->id,
            'section_id' => $this->section->id,
        ]);
    }

    public function test_index_returns_all_registrations(): void
    {
        $this->actingAs($this->createUser())
            ->getJson('/api/v1/registrations')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Liste des inscriptions récupérée avec succès.',
            ])
            ->assertJsonStructure(['data' => ['*' => ['id', 'student_id', 'status']]]);
    }

    public function test_store_creates_registration(): void
    {
        $data = [
            'student_id' => $this->student->id,
            'guardian_id' => $this->guardian->id,
            'school_id' => $this->school->id,
            'year_id' => $this->year->id,
            'classroom_id' => $this->classroom->id,
            'section_id' => $this->section->id,
            'registration_date' => '2026-03-01',
            'status' => 'active',
        ];

        $this->actingAs($this->createUser())
            ->postJson('/api/v1/registrations', $data)
            ->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Inscription créée avec succès.',
            ]);

        $this->assertDatabaseHas('registrations', [
            'student_id' => $this->student->id,
            'status' => 'active',
        ]);
    }

    public function test_show_returns_registration(): void
    {
        $this->actingAs($this->createUser())
            ->getJson("/api/v1/registrations/{$this->registration->id}")
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Inscription récupérée avec succès.',
                'data' => [
                    'id' => $this->registration->id,
                    'student_id' => $this->registration->student_id,
                ],
            ]);
    }

    public function test_update_modifies_registration(): void
    {
        $data = [
            'student_id' => $this->student->id,
            'guardian_id' => $this->guardian->id,
            'school_id' => $this->school->id,
            'year_id' => $this->year->id,
            'classroom_id' => $this->classroom->id,
            'section_id' => $this->section->id,
            'registration_date' => '2026-03-02',
            'status' => 'cancelled',
        ];

        $this->actingAs($this->createUser())
            ->putJson("/api/v1/registrations/{$this->registration->id}", $data)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Inscription mise à jour avec succès.',
            ]);

        $this->assertDatabaseHas('registrations', [
            'id' => $this->registration->id,
            'status' => 'cancelled',
        ]);
    }

    public function test_destroy_deletes_registration(): void
    {
        $this->actingAs($this->createUser())
            ->deleteJson("/api/v1/registrations/{$this->registration->id}")
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Inscription supprimée avec succès.',
            ]);

        $this->assertDatabaseMissing('registrations', ['id' => $this->registration->id]);
    }

    public function test_change_status_updates_registration_status(): void
    {
        $this->actingAs($this->createUser())
            ->putJson("/api/v1/registrations/{$this->registration->id}/status", ['status' => 'pending'])
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Statut de l\'inscription mis à jour.',
            ]);

        $this->assertDatabaseHas('registrations', [
            'id' => $this->registration->id,
            'status' => 'pending',
        ]);
    }

    public function test_by_student_returns_student_registrations(): void
    {
        $this->actingAs($this->createUser())
            ->getJson("/api/v1/registrations/student/{$this->student->id}")
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Inscriptions de l\'étudiant récupérées.',
            ]);
    }

    private function createUser()
    {
        return \App\Models\User::factory()->create(['school_id' => $this->school->id]);
    }
}
