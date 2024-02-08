<?php
/**
 * Playground
 */
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers;

use Playground\Test\Models\User;
use Playground\Test\Models\UserWithRole;
use Tests\Feature\Playground\Site\Blade\TestCase;

/**
 * \Tests\Feature\Playground\Http\Controllers\Index\WelcomeRouteTest
 */
class WelcomeRouteTest extends TestCase
{
    public function test_route_welcome_as_guest_and_succeed(): void
    {
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);
    }

    public function test_route_json_welcome_as_guest_and_succeed(): void
    {
        $response = $this->json('GET', route('welcome'));
        $response->assertStatus(200);
    }

    public function test_route_welcome_as_user_and_succeed(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $response = $this->actingAs($user)->getJson(route('welcome'));
        $response->assertStatus(200);
    }

    public function test_route_json_welcome_as_manager_admin_and_succeed(): void
    {
        /**
         * @var UserWithRole $user
         */
        $user = UserWithRole::find(User::factory()->create()->getAttributeValue('id'));
        $user->setAttribute('role', 'manager-admin');
        $response = $this->actingAs($user)->getJson(route('welcome'));
        $response->assertStatus(200);
    }
}
