<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Feature\Playground\Site\Blade\Http\Controllers\Playground;

/**
 * \Tests\Feature\Playground\Site\Blade\Http\Controllers\Playground\TestTrait
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
        $app['config']->set('auth.providers.users.model', '\\Playground\\Test\\Models\\AppPlaygroundUser');

        $app['config']->set('playground-admin.load.migrations', true);

        $app['config']->set('app.debug', true);
        $app['config']->set('playground-auth.debug', true);

        $app['config']->set('playground-auth.verify', 'roles');
        $app['config']->set('playground-auth.sanctum', false);
        $app['config']->set('playground-auth.hasPrivilege', true);
        $app['config']->set('playground-auth.userPrivileges', true);
        $app['config']->set('playground-auth.hasRole', true);
        $app['config']->set('playground-auth.userRole', true);
        $app['config']->set('playground-auth.userRoles', true);
    }
}
