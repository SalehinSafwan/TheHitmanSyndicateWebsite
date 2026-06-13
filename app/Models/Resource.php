<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['type','description','availability'];

    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}
