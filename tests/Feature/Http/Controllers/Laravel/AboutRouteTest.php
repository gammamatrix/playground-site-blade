<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers\Laravel;

use Playground\Test\Models\User;
use Tests\Feature\Playground\Site\Blade\TestCase;

/**
 * \Tests\Feature\Playground\Http\Controllers\Index\AboutRouteTest
 */
class AboutRouteTest extends TestCase
{
    use TestTrait;

    protected bool $load_migrations_cms = true;

    protected bool $load_migrations_laravel = true;

    public function test_as_guest_and_succeed(): void
    {
        $response = $this->get(route('about'));
        $response->assertStatus(200);
    }

    public function test_json_as_guest_and_succeed(): void
    {
        $response = $this->json('GET', route('about'));
        $response->assertStatus(200);
    }

    public function test_as_user_and_succeed(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('about'));
        $response->assertStatus(200);
    }

    public function test_json_as_user_and_succeed(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $response = $this->actingAs($user)->getJson(route('about'));
        $response->assertStatus(200);
    }
}
