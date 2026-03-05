<?php

namespace Tests\Feature\Contracts;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateContractWithInvalidCollaboratorTest extends TestCase
{
    use RefreshDatabase;

    public function test_cannot_create_contract_with_nonexistent_collaborator()
    {
        $user=User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/contracts', [
            'collaborator_id' => 999, 
            'contract_type' => 'Fijo',
            'start_date' => '2026-01-01',
            'end_date' => '2026-12-31',
            'position' => 'Developer',
            'salary' => 3000000,
            'status' => 'Activo',
        ]);

        $response->assertStatus(422);
    }
}