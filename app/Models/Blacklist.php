<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    protected $fillable = ['hitman_id','reason'];

    public function hitman() {
        return $this->belongsTo(User::class, 'hitman_id');
    }
}
