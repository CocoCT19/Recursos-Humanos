<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractExtension extends Model
{
    protected $fillable = [
        'contract_id',
        'extension_type',
        'new_end_date',
        'additional_value',
        'description'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
