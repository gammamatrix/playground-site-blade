<?php
/**
 * Playground
 */
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers;

use Playground\Test\Models\User;
use Playground\Test\Models\UserWithRole;
use Tests\Feature\Playground\Site\Blade\TestCase;

// use Illuminate\Support\Facades\Artisan;

/**
 * \Tests\Feature\Playground\Http\Controllers\Index\AboutRouteTest
 */
class AboutRouteTest extends TestCase
{
    public function test_route_about_as_guest_and_succeed(): void
    {
        // $result = $this->withoutMockingConsoleOutput()->artisan('route:list -vvv');
        // dd(Artisan::output());
        $response = $this->get(route('about'));
        $response->assertStatus(200);
    }

    public function test_route_json_about_as_guest_and_succeed(): void
    {
        $response = $this->json('GET', route('about'));
        $response->assertStatus(200);
    }

    public function test_route_about_as_client_and_succeed(): void
    {
        /**
         * @var UserWithRole $user
         */
        $user = UserWithRole::find(User::factory()->create()->getAttributeValue('id'));
        $user->setAttribute('role', 'client');
        $response = $this->actingAs($user)->get(route('about'));
        $response->assertStatus(200);
    }

    public function test_route_json_about_as_manager_and_succeed(): void
    {
        /**
         * @var UserWithRole $user
         */
        $user = UserWithRole::find(User::factory()->create()->getAttributeValue('id'));
        $user->setAttribute('role', 'manager');
        $response = $this->actingAs($user)->getJson(route('about'));
        $response->assertStatus(200);
    }
}
