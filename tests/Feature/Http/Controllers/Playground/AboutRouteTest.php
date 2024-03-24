<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers\Playground;

use Playground\Test\Models\AppPlaygroundUser as User;
use Tests\Feature\Playground\Site\Blade\TestCase;

/**
 * \Tests\Feature\Playground\Http\Controllers\Index\AboutRouteTest
 */
class AboutRouteTest extends TestCase
{
    use TestTrait;

    protected bool $load_migrations_cms = true;

    protected bool $load_migrations_playground = true;

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

    public function test_as_client_and_succeed(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create(['role' => 'client']);
        $this->assertTrue($user->hasRole('client'));
        $response = $this->actingAs($user)->get(route('about'));
        $response->assertStatus(200);
    }

    public function test_json_as_client_and_succeed(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create(['role' => 'client']);
        $this->assertTrue($user->hasRole('client'));
        $response = $this->actingAs($user)->getJson(route('about'));
        $response->assertStatus(200);
    }

    public function test_as_manager_and_succeed(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create(['role' => 'manager']);
        $this->assertTrue($user->hasRole('manager'));
        $response = $this->actingAs($user)->get(route('about'));
        $response->assertStatus(200);
    }

    public function test_json_as_manager_and_succeed(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->manager()->create();
        $this->assertTrue($user->hasRole('manager'));
        $response = $this->actingAs($user)->getJson(route('about'));
        $response->assertStatus(200);
    }

    public function test_as_admin_and_succeed(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->admin()->create();
        $this->assertTrue($user->hasRole('admin'));
        $response = $this->actingAs($user)->get(route('about'));
        $response->assertStatus(200);
    }

    public function test_json_as_admin_and_succeed(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create(['role' => 'admin']);
        $this->assertTrue($user->hasRole('admin'));
        $response = $this->actingAs($user)->getJson(route('about'));
        $response->assertStatus(200);
    }
}
