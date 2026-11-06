<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'birthdate',
        'course',
        'confirmation_token',
        'confirmation_expires_at',
        'confirmed_at',
    ];

    protected $hidden = [
        'password',
        'confirmation_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'birthdate' => 'date',
            'confirmation_expires_at' => 'datetime',
            'confirmed_at' => 'datetime',
        ];
    }

    public function isConfirmed(): bool
    {
        return $this->confirmed_at !== null;
    }

    public function isExpired(): bool
    {
        return $this->confirmation_expires_at->isPast();
    }
}
