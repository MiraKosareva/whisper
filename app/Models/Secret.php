<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Secret extends Model
{
    protected $fillable = [
        'content',
        'token',
        'expires_at',
    ];

    protected $hidden = [
        'content',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
        ];      
    }

    public static function generateToken(): string
    {
        return hash('sha256', Str::random(40));
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }
}
