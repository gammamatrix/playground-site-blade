<?php
/**
 * Playground
 */
declare(strict_types=1);
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers\Laravel;

use Playground\Test\Models\User;
use Tests\Feature\Playground\Site\Blade\TestCase;

/**
 * \Tests\Feature\Playground\Http\Controllers\Index\UserDashboardRouteTest
 */
class UserDashboardRouteTest extends TestCase
{
    use TestTrait;

    protected bool $load_migrations_laravel = true;

    public function test_as_guest_and_fail_when_disabled_for_guest_and_no_redirect_with_auth_middleware(): void
    {
        config([
            'playground-site-blade.dashboard.enable' => true,
            'playground-site-blade.dashboard.guest' => false,
        ]);
        $response = $this->get('/dashboard?noredirect');
        // $response->dump();
        // Redirected by middleware
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_as_guest_and_redirect(): void
    {
        $response = $this->get(route('dashboard'));
        // Redirected by middleware
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_as_guest_and_redirect_when_disabled_for_guest(): void
    {
        config([
            'playground-site-blade.dashboard.enable' => true,
            'playground-site-blade.dashboard.guest' => false,
        ]);
        $response = $this->get(route('dashboard'));
        // Redirected by middleware
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_as_guest_and_fail(): void
    {
        config([
            'playground-site-blade.dashboard.enable' => true,
            'playground-site-blade.dashboard.guest' => true,
        ]);
        $response = $this->json('GET', route('dashboard'));
        $response->assertJson([
            'message' => 'Unauthenticated.',
        ]);
        $response->assertStatus(401);
    }

    public function test_as_user_and_succeed(): void
    {
        config([
            'playground-site-blade.dashboard.enable' => true,
            'playground-site-blade.dashboard.guest' => false,
        ]);
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertStatus(200);
    }

    public function test_as_user_and_fail_when_disabled_for_all(): void
    {
        config([
            'playground-site-blade.dashboard.enable' => false,
        ]);
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertRedirect('/');
    }

    public function test_as_user_and_fail_when_disabled_for_all_and_no_redirect(): void
    {
        config([
            'playground-site-blade.dashboard.enable' => false,
        ]);
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('dashboard', ['noredirect' => 1]));
        $response->assertStatus(404);
    }

    public function test_json_as_admin_and_succeed(): void
    {
        config([
            'playground-site-blade.dashboard.enable' => true,
        ]);
        /**
         * @var User $user
         */
        $user = User::factory()->admin()->create();
        $user->setAttribute('role', 'admin');
        $response = $this->actingAs($user)->getJson(route('dashboard'));
        $response->assertStatus(200);
    }
}
