<?php

namespace Tests\Feature;

use App\Models\School;
use App\Models\Year;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class YearControllerTest extends TestCase
{
    use RefreshDatabase;

    private School $school;

    private Year $year;

    protected function setUp(): void
    {
        parent::setUp();
        $this->school = School::factory()->create();
        $this->year = Year::factory()->create(['school_id' => $this->school->id]);
    }

    public function test_index_returns_all_years(): void
    {
        $this->actingAs($this->createUser())
            ->getJson('/api/v1/years')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Liste des années scolaires récupérée avec succès.',
            ])
            ->assertJsonStructure(['data' => ['*' => ['id', 'name', 'is_active']]]);
    }

    public function test_store_creates_year(): void
    {
        $data = [
            'school_id' => $this->school->id,
            'name' => '2026-2027',
            'is_active' => false,
            'start_date' => '2026-01-01',
            'end_date' => '2026-12-31',
        ];

        $this->actingAs($this->createUser())
            ->postJson('/api/v1/years', $data)
            ->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Année scolaire créée avec succès.',
            ]);

        $this->assertDatabaseHas('years', ['name' => '2026-2027']);
    }

    public function test_show_returns_year(): void
    {
        $this->actingAs($this->createUser())
            ->getJson("/api/v1/years/{$this->year->id}")
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Année scolaire récupérée avec succès.',
                'data' => [
                    'id' => $this->year->id,
                    'name' => $this->year->name,
                ],
            ]);
    }

    public function test_update_modifies_year(): void
    {
        $data = [
            'school_id' => $this->school->id,
            'name' => '2025-2026 Updated',
            'is_active' => true,
            'start_date' => '2025-01-01',
            'end_date' => '2025-12-31',
        ];

        $this->actingAs($this->createUser())
            ->putJson("/api/v1/years/{$this->year->id}", $data)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Année scolaire mise à jour avec succès.',
            ]);

        $this->assertDatabaseHas('years', ['id' => $this->year->id, 'name' => '2025-2026 Updated']);
    }

    public function test_destroy_deletes_year(): void
    {
        $this->actingAs($this->createUser())
            ->deleteJson("/api/v1/years/{$this->year->id}")
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Année scolaire supprimée avec succès.',
            ]);

        $this->assertDatabaseMissing('years', ['id' => $this->year->id]);
    }

    private function createUser()
    {
        return \App\Models\User::factory()->create(['school_id' => $this->school->id]);
    }
}
