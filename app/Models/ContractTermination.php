<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractTermination extends Model
{
    protected $fillable = [
        'contract_id',
        'termination_date',
        'reason'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
