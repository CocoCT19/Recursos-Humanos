<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = [
        'collaborator_id',
        'contract_type',
        'start_date',
        'end_date',
        'position',
        'salary',
        'status'
    ];

    public function collaborator()
    {
        return $this->belongsTo(Collaborator::class);
    }

    public function extensions()
    {
        return $this->hasMany(ContractExtension::class);
    }

    public function termination()
    {
        return $this->hasOne(ContractTermination::class);
    }
}
