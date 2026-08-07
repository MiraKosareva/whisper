<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Secret extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'token',
        'expires_at',
        'user_id',
        'max_views',
        'current_views',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generateToken(): string
    {
        return hash('sha256', Str::random(40));
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    public function canBeViewed(): bool
    {
    return !$this->isExpired() && $this->current_views < $this->max_views;
    }

    public function incrementViews(): void
{
    $this->increment('current_views');
    
    if ($this->current_views >= $this->max_views) {
        $this->delete();
    }
}
}