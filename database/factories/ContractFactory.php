<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Collaborator;

class ContractFactory extends Factory
{
    public function definition(): array
    {
        return [
            'collaborator_id' => Collaborator::factory(),
            'contract_type' => 'Fijo',
            'start_date' => now(),
            'end_date' => now()->addYear(),
            'position' => 'Developer',
            'salary' => 3000000,
            'status' => 'Activo',
        ];
    }
}