<?php

namespace Database\Factories;

use App\Models\Secret;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Secret>
 */
class SecretFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Secret::class;
    public function definition(): array
    {
        return [
            'content' => encrypt($this->faker->sentence(10)),
            'token' => Str::random(32),
            'expires_at' => now()->addHours(24),
            'user_id' => null,
            'max_views' => 3,
            'current_views' => 0,
        ];
    }

    public function expired(): self
    {
        return $this->state(fn (array $attributes) => [
            'expires_at' => now()->subHour(),
        ]);
    }

    public function viewedAll(): self
    {
        return $this->state(fn (array $attributes) => [
            'current_views' => $attributes['max_views'] ?? 3,
        ]);
    }
}
