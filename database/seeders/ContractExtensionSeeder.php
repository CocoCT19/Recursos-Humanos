<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contract;
use App\Models\ContractExtension;

class ContractExtensionSeeder extends Seeder
{
    public function run(): void
    {
        $contract = Contract::first();

        ContractExtension::create([
            'contract_id' => $contract->id,
            'extension_type' => 'Tiempo',
            'new_end_date' => '2025-06-30',
            'additional_value' => null,
            'description' => 'Prórroga por 6 meses'
        ]);
    }
}
