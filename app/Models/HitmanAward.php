<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HitmanAward extends Model
{
    protected $fillable = ['hitman_id','award_id'];

    public function hitman() {
        return $this->belongsTo(User::class, 'hitman_id');
    }

    public function award() {
        return $this->belongsTo(Award::class);
    }
}
