<?php

use App\Models\School;

it('can list schools', function () {
    School::factory()->count(3)->create();
    $response = $this->getJson('/schools');
    $response->assertStatus(200)
        ->assertJsonStructure([
            'success', 'message', 'data' => [['id', 'name', 'address', 'phone', 'email']],
        ]);
});

it('can create a school', function () {
    $data = School::factory()->make()->toArray();
    $response = $this->postJson('/schools', $data);
    $response->assertStatus(201)
        ->assertJson(['success' => true])
        ->assertJsonStructure(['data' => ['id', 'name', 'address', 'phone', 'email']]);
});

it('can update a school', function () {
    $school = School::factory()->create();
    $update = ['name' => 'Updated School'];
    $response = $this->putJson('/schools/'.$school->id, $update);
    $response->assertStatus(200)
        ->assertJson(['success' => true])
        ->assertJsonFragment(['name' => 'Updated School']);
});

it('can delete a school', function () {
    $school = School::factory()->create();
    $response = $this->deleteJson('/schools', ['id' => $school->id]);
    $response->assertStatus(200)
        ->assertJson(['success' => true]);
    $this->assertDatabaseMissing('schools', ['id' => $school->id]);
});
