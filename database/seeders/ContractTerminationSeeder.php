<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contract;
use App\Models\ContractTermination;

class ContractTerminationSeeder extends Seeder
{
    public function run(): void
    {
        $contract = Contract::first();

        ContractTermination::create([
            'contract_id' => $contract->id,
            'termination_date' => '2024-12-31',
            'reason' => 'Finalización de contrato por vencimiento'
        ]);
    }
}