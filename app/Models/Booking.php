<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['resource_id','hitman_id','booked_at'];

    public function resource() {
        return $this->belongsTo(Resource::class);
    }

    public function hitman() {
        return $this->belongsTo(User::class, 'hitman_id');
    }
}
