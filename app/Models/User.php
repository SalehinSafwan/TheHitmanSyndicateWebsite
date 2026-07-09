<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'codename',
        'specialty',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'hitman_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'hitman_id');
    }

    public function hasRole(string $roleName): bool
    {
        return $this->role === $roleName || $this->roles()->where('name', $roleName)->exists();
    }

    public function hasAnyRole(array $roleNames): bool
    {
        foreach ($roleNames as $roleName) {
            if ($this->hasRole($roleName)) {
                return true;
            }
        }

        return false;
    }

    public function assignRole(string $roleName): void
    {
        $role = Role::firstOrCreate(['name' => $roleName]);

        $this->roles()->syncWithoutDetaching($role->id);
        $this->role = $roleName;
        $this->save();
    }

    public function hitmanApplication(): HasOne
    {
        return $this->hasOne(HitmanApplication::class, 'user_id');
    }
}
