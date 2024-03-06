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
        // $app['config']->set('playground-auth.verify', 'privileges');
        $app['config']->set('playground-auth.sanctum', false);
        $app['config']->set('playground-auth.hasPrivilege', true);
        $app['config']->set('playground-auth.userPrivileges', true);
        $app['config']->set('playground-auth.hasRole', true);
        $app['config']->set('playground-auth.userRole', true);
        $app['config']->set('playground-auth.userRoles', true);

        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '__FILE__' => __FILE__,
        //     '__LINE__' => __LINE__,
        //     'config(playground-auth)' => config('playground-auth'),
        // ]);

        // $app['config']->set('playground-auth.token.roles', true);
        // $app['config']->set('playground-auth.token.sanctum', true);

        // $middleware = [];
        // api,auth:sanctum,web

        // $app['config']->set('playground-admin-resource.routes.admin', true);
        // $app['config']->set('playground-admin-resource.routes.users', true);
        // $app['config']->set('playground-admin-resource.routes.routes', true);

        // $app['config']->set('playground-admin-resource.sitemap.enable', true);
        // $app['config']->set('playground-admin-resource.sitemap.guest', true);
        // $app['config']->set('playground-admin-resource.sitemap.user', true);

    }
}
