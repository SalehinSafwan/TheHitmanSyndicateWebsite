<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionCompany extends Model
{
     protected $fillable = ['name','description','headquarters'];

    public function contracts() {
        return $this->belongsToMany(Contract::class, 'contract_production');
    }
}
