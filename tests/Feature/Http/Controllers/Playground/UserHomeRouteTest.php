<?php
/**
 * Playground
 */
declare(strict_types=1);
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers\Playground;

use Playground\Test\Models\AppPlaygroundUser as User;
use Tests\Feature\Playground\Site\Blade\TestCase;

/**
 * \Tests\Feature\Playground\Http\Controllers\Index\UserHomeRouteTest
 */
class UserHomeRouteTest extends TestCase
{
    use TestTrait;

    protected bool $load_migrations_cms = true;

    protected bool $load_migrations_playground = true;

    public function test_route_home_as_guest_and_fail(): void
    {
        $response = $this->get(route('home'));
        // Redirected by middleware
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_route_json_home_as_guest_and_fail(): void
    {
        $response = $this->json('GET', route('home'));
        // Redirected by middleware
        $response->assertJson([
            'message' => 'Unauthenticated.',
        ]);
        $response->assertStatus(401);
    }

    public function test_route_home_as_user_admin_and_succeed(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)->get(route('home'));
        $response->assertStatus(200);
    }

    public function test_route_json_home_as_admin_and_succeed(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)->getJson(route('home'));
        $response->assertStatus(200);
    }
}
