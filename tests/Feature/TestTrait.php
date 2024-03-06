<?php

declare(strict_types=1);
/**
 * Playground
 */
namespace Tests\Feature\Playground\Site\Blade;

use Playground\Auth\ServiceProvider as PlaygroundAuthServiceProvider;
use Playground\Blade\ServiceProvider as PlaygroundBladeServiceProvider;
use Playground\Login\Blade\ServiceProvider as PlaygroundLoginBladeServiceProvider;
// use Playground\Http\ServiceProvider as PlaygroundHttpServiceProvider;
// use Playground\Admin\ServiceProvider as PlaygroundAdminServiceProvider;
use Playground\ServiceProvider as PlaygroundServiceProvider;
use Playground\Site\Blade\ServiceProvider;
// use Playground\Admin\Resource\ServiceProvider as PlaygroundAdminResourceServiceProvider;;
use Playground\Site\Blade\ServiceProvider as PlaygroundSiteBladeServiceProvider;

/**
 * \Tests\Feature\Playground\Site\Blade\TestTrait
 */
trait TestTrait
{
    protected function getPackageProviders($app)
    {
        return [
            PlaygroundAuthServiceProvider::class,
            PlaygroundBladeServiceProvider::class,
            // PlaygroundHttpServiceProvider::class,
            PlaygroundLoginBladeServiceProvider::class,
            PlaygroundSiteBladeServiceProvider::class,
            // PlaygroundAdminServiceProvider::class,
            // PlaygroundAdminResourceServiceProvider::class,
            PlaygroundServiceProvider::class,
            ServiceProvider::class,
        ];
    }
}
