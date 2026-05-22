<?php

namespace Database\Seeders;

use App\Models\Secret;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $secrets = [
            'Я скрываю, что знаю Laravel лучше, чем говорю на собеседованиях.',
            'В детстве я верил, что программисты не спят никогда.',
            'Мой кот умнее некоторых моих коллег.',
            'Иногда я компилирую код мысленно перед сном.',
            'Я до сих пор не понимаю, как работает float в JavaScript.',
        ];

        foreach ($secrets as $content)
            {
                Secret::create([
                    'content' => encrypt($content),
                    'token' => Secret::generateToken(),
                    'expires_at' => now()->addDays(rand(1, 7)),
                ]);
            }
    }
}
