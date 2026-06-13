<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $fillable = ['name','description'];

    public function hitmen() {
        return $this->belongsToMany(User::class, 'hitman_awards');
    }
}
