<?php

namespace Tests\Feature\Contracts;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Collaborator;

class ContractValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_contract_validates_dates_and_salary()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $collaborator = Collaborator::factory()->create();

        
        $response = $this->postJson('/contracts', [
            'collaborator_id' => $collaborator->id,
            'contract_type' => 'Fijo',
            'start_date' => '2026-12-31',
            'end_date' => '2026-01-01', 
            'position' => 'Developer',
            'salary' => -1000, 
            'status' => 'Activo',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['end_date', 'salary']);
    }
}