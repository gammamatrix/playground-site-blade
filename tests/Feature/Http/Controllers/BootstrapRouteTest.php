<?php
/**
 * Playground
 */
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers;

use Playground\Test\Models\User;
use Playground\Test\Models\UserWithRole;
use Tests\Feature\Playground\Site\Blade\TestCase;

/**
 * \Tests\Feature\Playground\Http\Controllers\Index\BootstrapRouteTest
 */
class BootstrapRouteTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
        config([
            'playground-site-blade.load.routes' => true,
            'playground-site-blade.routes.bootstrap' => true,
        ]);
    }

    public function test_route_bootstrap_as_guest_and_succeed(): void
    {
        $response = $this->get(route('bootstrap'));
        $response->assertStatus(200);
    }

    public function test_route_json_bootstrap_as_guest_and_succeed(): void
    {
        $response = $this->json('GET', route('bootstrap'));
        $response->assertStatus(200);
    }

    public function test_route_bootstrap_as_vendor_and_succeed(): void
    {
        /**
         * @var UserWithRole $user
         */
        $user = UserWithRole::find(User::factory()->create()->getAttributeValue('id'));
        $user->setAttribute('role', 'vendor');
        $response = $this->actingAs($user)->get(route('bootstrap'));
        $response->assertStatus(200);
    }

    public function test_route_json_bootstrap_as_wheel_and_succeed(): void
    {
        /**
         * @var UserWithRole $user
         */
        $user = UserWithRole::find(User::factory()->create()->getAttributeValue('id'));
        $user->setAttribute('role', 'wheel');
        $response = $this->actingAs($user)->getJson(route('bootstrap'));
        $response->assertStatus(200);
    }
}
