<?php
/**
 * Playground
 */
namespace Tests\Feature\Playground\Site\Blade;

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Playground\Blade\ServiceProvider as PlaygroundBladeServiceProvider;
use Playground\Login\Blade\ServiceProvider as PlaygroundLoginBladeServiceProvider;
use Playground\ServiceProvider as PlaygroundServiceProvider;
use Playground\Site\Blade\ServiceProvider;
use Playground\Test\OrchestraTestCase;

/**
 * \Tests\Feature\Playground\Site\Blade\TestCase
 */
class TestCase extends OrchestraTestCase
{
    use DatabaseTransactions;
    use InteractsWithViews;

    protected function getPackageProviders($app)
    {
        return [
            PlaygroundServiceProvider::class,
            PlaygroundLoginBladeServiceProvider::class,
            PlaygroundBladeServiceProvider::class,
            ServiceProvider::class,
        ];
    }

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        if (! empty(env('TEST_DB_MIGRATIONS'))) {
            // $this->loadLaravelMigrations();
            $this->loadMigrationsFrom(dirname(dirname(__DIR__)).'/database/migrations-laravel');
        }
    }

    /**
     * Set up the environment.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        // dd(__METHOD__);
        $app['config']->set('auth.providers.users.model', 'Playground\\Test\\Models\\User');
        $app['config']->set('playground-site-blade.auth.verify', 'user');
    }
}
