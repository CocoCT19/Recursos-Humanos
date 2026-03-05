<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Collaborator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateContractTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_contract_for_existing_collaborator()
    {
        $user = User::factory()->create();
        $collaborator = Collaborator::factory()->create();

        $response = $this->actingAs($user)->post('/contracts', [
            'collaborator_id' => $collaborator->id,
            'contract_type'   => 'Fijo',
            'start_date'      => '2024-01-01',
            'end_date'        => '2024-12-31',
            'position'        => 'Developer',
            'salary'          => 3000000,
            'status'          => 'Activo',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('contracts', [
            'collaborator_id' => $collaborator->id,
            'position'        => 'Developer',
        ]);
    }
}