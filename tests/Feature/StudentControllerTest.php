<?php

namespace Tests\Feature;

use App\Models\Guardian;
use App\Models\School;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    private School $school;

    private Guardian $guardian;

    private Student $student;

    protected function setUp(): void
    {
        parent::setUp();
        $this->school = School::factory()->create();
        $this->guardian = Guardian::factory()->create(['school_id' => $this->school->id]);
        $this->student = Student::factory()->create([
            'school_id' => $this->school->id,
            'guardian_id' => $this->guardian->id,
        ]);
    }

    public function test_index_returns_all_students(): void
    {
        $this->actingAs($this->createUser())
            ->getJson('/api/v1/students')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Liste des étudiants récupérée avec succès.',
            ])
            ->assertJsonStructure(['data' => ['*' => ['id', 'matricule', 'name', 'email']]]);
    }

    public function test_store_creates_student(): void
    {
        $data = [
            'matricule' => 'STU001',
            'name' => 'Alice',
            'post_name' => 'Johnson',
            'email' => 'alice@example.com',
            'phone' => '987654321',
            'birth_date' => '2010-05-15',
            'address' => '456 Oak Ave',
            'school_id' => $this->school->id,
            'guardian_id' => $this->guardian->id,
        ];

        $this->actingAs($this->createUser())
            ->postJson('/api/v1/students', $data)
            ->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Étudiant créé avec succès.',
            ]);

        $this->assertDatabaseHas('students', ['matricule' => 'STU001']);
    }

    public function test_show_returns_student(): void
    {
        $this->actingAs($this->createUser())
            ->getJson("/api/v1/students/{$this->student->id}")
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Étudiant récupéré avec succès.',
                'data' => [
                    'id' => $this->student->id,
                    'matricule' => $this->student->matricule,
                ],
            ]);
    }

    public function test_update_modifies_student(): void
    {
        $data = [
            'matricule' => $this->student->matricule,
            'name' => 'Bob',
            'post_name' => 'Smith',
            'email' => 'bob@example.com',
            'school_id' => $this->school->id,
            'guardian_id' => $this->guardian->id,
        ];

        $this->actingAs($this->createUser())
            ->putJson("/api/v1/students/{$this->student->id}", $data)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Étudiant mis à jour avec succès.',
            ]);

        $this->assertDatabaseHas('students', ['id' => $this->student->id, 'name' => 'Bob']);
    }

    public function test_destroy_deletes_student(): void
    {
        $this->actingAs($this->createUser())
            ->deleteJson("/api/v1/students/{$this->student->id}")
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Étudiant supprimé avec succès.',
            ]);

        $this->assertDatabaseMissing('students', ['id' => $this->student->id]);
    }

    private function createUser()
    {
        return \App\Models\User::factory()->create(['school_id' => $this->school->id]);
    }
}
