<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractProduction extends Model
{
    protected $fillable = ['contract_id','production_company_id'];

    public function contract() {
        return $this->belongsTo(Contract::class);
    }

    public function productionCompany() {
        return $this->belongsTo(ProductionCompany::class);
    }
}
