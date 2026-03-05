<?php

namespace Tests\Feature\Contracts;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Collaborator;
use App\Models\Contract;

class UpdateContractTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_update_existing_contract()
    {
        $user=User::factory()->create();
        $this->actingAs($user);

        $collaborator = Collaborator::factory()->create();

        $contract = Contract::factory()->create([
            'collaborator_id' => $collaborator->id,
        ]);

        $response = $this->putJson("/contracts/{$contract->id}", [
            'collaborator_id' => $collaborator->id,
            'contract_type' => 'Indefinido',
            'start_date' => '2026-01-01',
            'end_date' => null,
            'position' => 'Senior Developer',
            'salary' => 5000000,
            'status' => 'Activo',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('contracts', [
            'id' => $contract->id,
            'position' => 'Senior Developer',
            'salary' => 5000000,
        ]);
    }
}