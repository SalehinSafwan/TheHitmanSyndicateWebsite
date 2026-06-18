<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HitmanApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'codename',
        'specialty',
        'email',
        'password',
        'referral_codename',
        'currency_answer',
        'hotel_rule_answer',
        'best_weapon_answer',
        'motivation',
        'status',
        'reviewed_by',
        'reviewed_at',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'reviewed_at' => 'datetime',
        ];
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}