<?php
/**
 * Playground
 */
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers;

use Playground\Test\Models\User;
use Playground\Test\Models\UserWithRole;
use Tests\Feature\Playground\Site\Blade\TestCase;

/**
 * \Tests\Feature\Playground\Http\Controllers\Index\UserHomeRouteTest
 */
class UserHomeRouteTest extends TestCase
{
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
         * @var UserWithRole $user
         */
        $user = UserWithRole::find(User::factory()->create()->getAttributeValue('id'));
        $user->setAttribute('role', 'user-admin');
        $response = $this->actingAs($user)->get(route('home'));
        $response->assertStatus(200);
    }

    public function test_route_json_home_as_admin_and_succeed(): void
    {
        /**
         * @var UserWithRole $user
         */
        $user = UserWithRole::find(User::factory()->create()->getAttributeValue('id'));
        $user->setAttribute('role', 'root');
        $response = $this->actingAs($user)->getJson(route('home'));
        $response->assertStatus(200);
    }
}
