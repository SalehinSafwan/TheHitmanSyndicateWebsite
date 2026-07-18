<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = ['title', 'target', 'bounty', 'status', 'user_id'];

    public function assignments() {
        return $this->hasMany(ContractAssignment::class);
    }

    public function assignee() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function productionCompanies() {
        return $this->belongsToMany(ProductionCompany::class, 'contract_production');
    }
}
