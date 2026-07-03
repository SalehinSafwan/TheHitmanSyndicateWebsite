<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    protected $table = 'ledger';
    protected $fillable = ['contract_id','hitman_id','amount','paid_at'];

    public function contract() {
        return $this->belongsTo(Contract::class);
    }

    public function hitman() {
        return $this->belongsTo(User::class, 'hitman_id');
    }
}
