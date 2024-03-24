<?php

declare(strict_types=1);
/**
 * Playground
 */
namespace Tests\Feature\Playground\Site\Blade;

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Carbon;
use Playground\Test\OrchestraTestCase;

/**
 * \Tests\Feature\Playground\Site\Blade\TestCase
 */
class TestCase extends OrchestraTestCase
{
    use DatabaseTransactions;
    use InteractsWithViews;
    use TestTrait;

    protected bool $load_migrations_cms = false;

    protected bool $load_migrations_laravel = false;

    protected bool $load_migrations_playground = false;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow(Carbon::now());

        if (! empty(env('TEST_DB_MIGRATIONS'))) {
            if ($this->load_migrations_cms) {
                $this->loadMigrationsFrom(dirname(dirname(__DIR__)).'/database/migrations-cms-uuid');
            }
            if ($this->load_migrations_laravel) {
                $this->loadMigrationsFrom(dirname(dirname(__DIR__)).'/database/migrations-laravel');
            }
            if ($this->load_migrations_playground) {
                $this->loadMigrationsFrom(dirname(dirname(__DIR__)).'/database/migrations-playground');
            }
        }
    }

    /**
     * Set up the environment.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('auth.providers.users.model', '\\Playground\\Test\\Models\\User');

        $app['config']->set('app.debug', false);
        $app['config']->set('playground-auth.debug', false);

        $app['config']->set('playground-auth.verify', 'user');
        $app['config']->set('playground-auth.sanctum', false);
        $app['config']->set('playground-auth.hasPrivilege', false);
        $app['config']->set('playground-auth.userPrivileges', false);
        $app['config']->set('playground-auth.hasRole', false);
        $app['config']->set('playground-auth.userRole', false);
        $app['config']->set('playground-auth.userRoles', false);
    }
}
