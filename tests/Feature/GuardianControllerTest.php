<?php

namespace Tests\Feature;

use App\Models\Guardian;
use App\Models\School;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuardianControllerTest extends TestCase
{
    use RefreshDatabase;

    private School $school;

    private Guardian $guardian;

    protected function setUp(): void
    {
        parent::setUp();
        $this->school = School::factory()->create();
        $this->guardian = Guardian::factory()->create(['school_id' => $this->school->id]);
    }

    public function test_index_returns_all_guardians(): void
    {
        $this->actingAs($this->createUser())
            ->getJson('/api/v1/guardians')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Liste des parents récupérée avec succès.',
            ])
            ->assertJsonStructure(['data' => ['*' => ['id', 'first_name', 'last_name', 'email']]]);
    }

    public function test_store_creates_guardian(): void
    {
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
            'address' => '123 Main St',
            'school_id' => $this->school->id,
        ];

        $this->actingAs($this->createUser())
            ->postJson('/api/v1/guardians', $data)
            ->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Parent créé avec succès.',
            ]);

        $this->assertDatabaseHas('guardians', ['email' => 'john@example.com']);
    }

    public function test_show_returns_guardian(): void
    {
        $this->actingAs($this->createUser())
            ->getJson("/api/v1/guardians/{$this->guardian->id}")
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Parent récupéré avec succès.',
                'data' => [
                    'id' => $this->guardian->id,
                    'first_name' => $this->guardian->first_name,
                ],
            ]);
    }

    public function test_update_modifies_guardian(): void
    {
        $data = [
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane@example.com',
            'school_id' => $this->school->id,
        ];

        $this->actingAs($this->createUser())
            ->putJson("/api/v1/guardians/{$this->guardian->id}", $data)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Parent mis à jour avec succès.',
            ]);

        $this->assertDatabaseHas('guardians', ['id' => $this->guardian->id, 'first_name' => 'Jane']);
    }

    public function test_destroy_deletes_guardian(): void
    {
        $this->actingAs($this->createUser())
            ->deleteJson("/api/v1/guardians/{$this->guardian->id}")
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Parent supprimé avec succès.',
            ]);

        $this->assertDatabaseMissing('guardians', ['id' => $this->guardian->id]);
    }

    private function createUser()
    {
        return \App\Models\User::factory()->create();
    }
}
