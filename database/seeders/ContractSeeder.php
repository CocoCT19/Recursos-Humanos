<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contract;
use App\Models\Collaborator;

class ContractSeeder extends Seeder
{
    public function run(): void
    {
        $collaborator = Collaborator::first();

        Contract::create([
            'collaborator_id' => $collaborator->id,
            'contract_type' => 'Fijo',
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-31',
            'position' => 'Desarrollador',
            'salary' => 3500000,
            'status' => 'Activo'
        ]);
    }
}
