<?php
/**
 * Playground
 */
declare(strict_types=1);
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers\Playground;

use Playground\Test\Models\AppPlaygroundUser as User;
use Tests\Feature\Playground\Site\Blade\TestCase;

/**
 * \Tests\Feature\Playground\Site\Blade\Http\Controllers\Playground\PublicHomeRouteTest
 */
class PublicHomeRouteTest extends TestCase
{
    use TestTrait;

    protected bool $load_migrations_playground = true;

    /**
     * Set up the environment.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('playground-site-blade.middleware.home', 'web');
    }

    public function test_as_guest_and_succeed(): void
    {
        $response = $this->get(route('home'));
        $response->assertStatus(200);
    }

    public function test_json_as_guest_and_succeed(): void
    {
        $response = $this->json('GET', route('home'));
        $response->assertStatus(200);
    }

    public function test_as_admin_and_succeed(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)->get(route('home'));
        $response->assertStatus(200);
    }

    public function test_json_as_admin_and_succeed(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)->getJson(route('home'));
        $response->assertStatus(200);
    }
}
