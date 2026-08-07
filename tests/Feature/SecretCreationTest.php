<?php

namespace Tests\Feature;

use App\Models\Secret;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SecretCreationTest extends TestCase
{

    use RefreshDatabase;
    
    // ======test model======
    public function test_secret_can_be_created()
    {
        $secret = Secret::factory()->create([
            'content' => encrypt('Мой секретный секрет'),
            'max_views' => 1,
        ]);

        $this->assertDatabaseHas('secrets', [
            'id' => $secret->id,
            'max_views' => 1,
            'current_views' => 0,
        ]);

        $this->assertEquals('Мой секретный секрет', decrypt($secret->content));
    }

    public function test_secret_can_check_if_it_is_expired()
    {
        $activeSecret = Secret::factory()->create();
        $this->assertFalse($activeSecret->isExpired());
        $this->assertTrue($activeSecret->canBeViewed());

        $expiredSecret = Secret::factory()->expired()->create();
        $this->assertTrue($expiredSecret->isExpired());
        $this->assertFalse($expiredSecret->canBeViewed());
    }

    public function test_secret_can_check_if_it_can_be_viewed()
    {
        $secret = Secret::factory()->create(['max_views' => 3]);

        $this->assertTrue($secret->canBeViewed());

        $secret->current_views = 3;
        $this->assertFalse($secret->canBeViewed());
    }

    public function test_secret_auto_deletes_when_max_views_reached()
    {
        $secret = Secret::factory()->create([
            'max_views' => 2,
            'current_views' => 1,
        ]);

        $this->assertDatabaseHas('secrets', ['id' => $secret->id]);

        $secret->incrementViews();

        $this->assertDatabaseMissing('secrets', ['id' => $secret->id]);
    }


    // ======test controller======
    public function test_guest_can_create_secret()
    {
        $data = [
            'content' => 'Мое супер секретное сообщение',
            'max_views' => 5,
        ];

        $response = $this->post(route('secrets.store'), $data);

         $response->assertStatus(200);

        $this->assertDatabaseHas('secrets', [
            'max_views' => 5,
            'user_id' => null,
        ]);

        $secret = Secret::latest()->first();
        
        $this->assertNotEquals($data['content'], $secret->content);
        $this->assertEquals($data['content'], decrypt($secret->content));
    }

    public function test_authenticated_user_can_create_secret()
    {
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user);

        $data = [
            'content' => 'Мое секретное сообщение',
            'max_views' => 3,
        ];

        $response = $this->post(route('secrets.store'), $data);

        $this->assertDatabaseHas('secrets', [
            'user_id' => $user->id,
            'max_views' => 3,
        ]);
    }

    public function test_secret_can_be_viewed_by_token()
    {
        $secret = Secret::factory()->create([
            'content' => encrypt('Секретное сообщение'),
            'max_views' => 2,
            'current_views' => 0,
        ]);

        $response = $this->get(route('secrets.show', $secret->token));
        $response->assertStatus(200);
        $response->assertSee('Секретное сообщение');

        $this->assertDatabaseHas('secrets', [
            'id' => $secret->id,
            'current_views' => 1,
        ]);

        $response = $this->get(route('secrets.show', $secret->token));
        $response->assertStatus(200);

        $response = $this->get(route('secrets.show', $secret->token));
        $response->assertStatus(404);
    }

    public function test_expired_secret_returns_404()
    {
        $secret = Secret::factory()->expired()->create();

        $response = $this->get(route('secrets.show', $secret->token));
        $response->assertStatus(404);
    }

    public function test_user_can_see_their_secrets_in_dashboard()
    {
        $user = \App\Models\User::factory()->create();
        Secret::factory()->count(3)->create(['user_id' => $user->id]);
        Secret::factory()->count(2)->create();

        $this->actingAs($user);

        $response = $this->get(route('dashboard'));

        $response->assertStatus(200);
        $this->assertEquals(3, Secret::where('user_id', $user->id)->count());
    }


    // ======test console commands======
    public function test_console_command_deletes_expired_secrets()
    {
        Secret::factory()->expired()->count(3)->create();
        Secret::factory()->count(2)->create();

        $this->artisan('secrets:delete-expired')
            ->expectsOutput('Удалено 3 просроченных секретов')
            ->assertExitCode(0);

        $this->assertDatabaseCount('secrets', 2);
    }

}
