<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers\Laravel;

use Tests\Feature\Playground\Site\Blade\TestCase;

/**
 * \Tests\Feature\Playground\Site\Blade\Http\Controllers\Laravel\PublicDashboardRouteTest
 */
class PublicDashboardRouteTest extends TestCase
{
    use TestTrait;

    protected bool $load_migrations_laravel = true;

    /**
     * Set up the environment.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('playground-site-blade.middleware.dashboard', 'web');
    }

    public function test_as_guest_and_fail_when_disabled_for_guest_and_no_redirect(): void
    {
        config([
            'playground-site-blade.dashboard.enable' => true,
            'playground-site-blade.dashboard.guest' => false,
        ]);

        $response = $this->get('/dashboard?noredirect');
        // $response->dump();

        $response->assertStatus(401);
    }

    public function test_as_guest_and_redirect_when_disabled_for_all(): void
    {
        config([
            'playground-site-blade.dashboard.enable' => false,
        ]);
        $response = $this->get(route('dashboard'));
        $response->assertRedirect('/');
    }

    public function test_as_guest_and_redirect_when_disabled_for_guest(): void
    {
        config([
            'playground-site-blade.dashboard.enable' => true,
            'playground-site-blade.dashboard.guest' => false,
        ]);
        $response = $this->get(route('dashboard'));
        $response->assertRedirect('/');
    }

    public function test_as_guest_and_succeed(): void
    {
        config([
            'playground-site-blade.dashboard.enable' => true,
            'playground-site-blade.dashboard.guest' => true,
        ]);
        $response = $this->json('GET', route('dashboard'));
        $response->assertStatus(200);
    }
}
