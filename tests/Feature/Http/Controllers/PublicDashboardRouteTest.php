<?php
/**
 * Playground
 */
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Tests\Feature\Playground\Site\Blade\TestCase;

/**
 * \Tests\Feature\Playground\Http\Controllers\Index\PublicDashboardRouteTest
 */
class PublicDashboardRouteTest extends TestCase
{
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

    public function test_route_dashboard_as_guest_and_fail_when_disabled_for_guest_and_no_redirect(): void
    {
        config([
            'playground-site-blade.dashboard.enable' => true,
            'playground-site-blade.dashboard.guest' => false,
        ]);
        // dump(config('playground-site-blade'));

        // $result = $this->withoutMockingConsoleOutput()->artisan('route:list -vvv');
        // dd(Artisan::output());
        $response = $this->get('/dashboard?noredirect');
        // $response->dump();
        // Redirected by controller
        $response->assertStatus(401);
    }

    public function test_route_dashboard_as_guest_and_redirect_when_disabled_for_all(): void
    {
        config([
            'playground-site-blade.dashboard.enable' => false,
        ]);
        $response = $this->get(route('dashboard'));
        $response->assertRedirect('/');
    }

    public function test_route_dashboard_as_guest_and_redirect_when_disabled_for_guest(): void
    {
        config([
            'playground-site-blade.dashboard.enable' => true,
            'playground-site-blade.dashboard.guest' => false,
        ]);
        $response = $this->get(route('dashboard'));
        $response->assertRedirect('/');
    }

    public function test_route_json_dashboard_as_guest_and_succeed(): void
    {
        config([
            'playground-site-blade.dashboard.enable' => true,
            'playground-site-blade.dashboard.guest' => true,
        ]);
        $response = $this->json('GET', route('dashboard'));
        $response->assertStatus(200);
    }
}
