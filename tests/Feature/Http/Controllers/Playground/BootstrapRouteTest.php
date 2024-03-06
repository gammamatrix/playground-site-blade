<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers\Playground;

use Playground\Test\Models\AppPlaygroundUser as User;
use Tests\Feature\Playground\Site\Blade\TestCase;

/**
 * \Tests\Feature\Playground\Site\Blade\Http\Controllers\Playground\BootstrapRouteTest
 */
class BootstrapRouteTest extends TestCase
{
    use TestTrait;

    protected bool $load_migrations_playground = true;

    public function test_as_guest_and_succeed(): void
    {
        $response = $this->get(route('bootstrap'));
        $response->assertStatus(200);
    }

    public function test_json_as_guest_and_succeed(): void
    {
        $response = $this->json('GET', route('bootstrap'));
        $response->assertStatus(200);
    }

    public function test_as_wheel_and_succeed(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->wheel()->create();
        $response = $this->actingAs($user)->get(route('bootstrap'));
        $response->assertStatus(200);
    }

    public function test_json_as_wheel_and_succeed(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->wheel()->create();
        $response = $this->actingAs($user)->getJson(route('bootstrap'));
        $response->assertStatus(200);
    }
}
