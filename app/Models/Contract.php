<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = ['title','target','bounty','status'];

    public function assignments() {
        return $this->hasMany(ContractAssignment::class);
    }

    public function productionCompanies() {
        return $this->belongsToMany(ProductionCompany::class, 'contract_production');
    }
}
