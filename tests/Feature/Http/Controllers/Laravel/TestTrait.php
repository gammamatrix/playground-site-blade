<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers\Laravel;

/**
 * \Tests\Feature\Playground\Site\Blade\Http\Controllers\Laravel\TestTrait
 */
trait TestTrait
{
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
