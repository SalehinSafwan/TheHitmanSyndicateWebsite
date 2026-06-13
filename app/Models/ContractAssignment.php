<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractAssignment extends Model
{
    protected $fillable = ['contract_id','hitman_id','assigned_at'];

    public function contract() {
        return $this->belongsTo(Contract::class);
    }

    public function hitman() {
        return $this->belongsTo(User::class, 'hitman_id');
    }
}
