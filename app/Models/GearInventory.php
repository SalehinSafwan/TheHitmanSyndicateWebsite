<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GearInventory extends Model
{
    protected $fillable = ['hitman_id','gear_name','gear_type'];

    public function hitman() {
        return $this->belongsTo(User::class, 'hitman_id');
    }
}
