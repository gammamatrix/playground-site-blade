<?php
/**
 * Playground
 */
namespace Playground\Site\Blade;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
use Illuminate\Support\Str;

/**
 * \Playground\Site\Blade\ServiceProvider
 */
class ServiceProvider extends AuthServiceProvider
{
    protected string $package = 'playground-site-blade';

    public const VERSION = '73.0.0';

    public function boot(): void
    {
        /**
         * @var array<string, mixed> $config
         */
        $config = config($this->package);

        if (! empty($config['load']) && is_array($config['load'])) {

            if (! empty($config['load']['routes']) && is_array($config['routes'])) {
                $this->routes($config['routes']);
            }

            if (! empty($config['load']['views'])) {
                $this->loadViewsFrom(
                    dirname(__DIR__).'/resources/views',
                    'playground-site'
                );
            }

            if ($this->app->runningInConsole()) {
                // Publish configuration
                $this->publishes([
                    sprintf('%1$s/config/%2$s.php', dirname(__DIR__), $this->package) => config_path(sprintf('%1$s.php', $this->package)),
                ], 'playground-config');

                // Publish Blade Views
                $this->publishes([
                    dirname(__DIR__).'/resources/views' => resource_path(Str::of('vendor/'.$this->package)->beforeLast('-blade')),
                ], 'playground-blade');
            }

            $this->about();
        }
    }

    public function about(): void
    {
        $config = config($this->package);
        $config = is_array($config) ? $config : [];

        $load = ! empty($config['load']) && is_array($config['load']) ? $config['load'] : [];

        $routes = ! empty($config['routes']) && is_array($config['routes']) ? $config['routes'] : [];

        $sitemap = ! empty($config['sitemap']) && is_array($config['sitemap']) ? $config['sitemap'] : [];

        $version = $this->version();

        AboutCommand::add('Playground: Site Blade', fn () => [
            '<fg=yellow;options=bold>Load</> Views' => ! empty($load['views']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',

            '<fg=blue;options=bold>View</> [layout]' => sprintf('[%s]', $config['layout']),
            '<fg=blue;options=bold>View</> [prefix]' => sprintf('[%s]', $config['view']),

            '<fg=magenta;options=bold>Sitemap</> Views' => ! empty($sitemap['enable']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=magenta;options=bold>Sitemap</> Guest' => ! empty($sitemap['guest']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=magenta;options=bold>Sitemap</> User' => ! empty($sitemap['user']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=magenta;options=bold>Sitemap</> [view]' => sprintf('[%s]', $sitemap['view']),

            '<fg=magenta;options=bold>Dashboard</> Views' => ! empty($config['dashboard']['enable']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=magenta;options=bold>Dashboard</> Guest' => ! empty($config['dashboard']['guest']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=magenta;options=bold>Dashboard</> User' => ! empty($config['dashboard']['user']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=magenta;options=bold>Dashboard</> [view]' => sprintf('[%s]', $config['dashboard']['view']),

            '<fg=red;options=bold>Route</> about' => ! empty($routes['about']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=red;options=bold>Route</> bootstrap' => ! empty($routes['bootstrap']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=red;options=bold>Route</> dashboard' => ! empty($routes['dashboard']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=red;options=bold>Route</> home' => ! empty($routes['home']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=red;options=bold>Route</> index' => ! empty($routes['index']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=red;options=bold>Route</> sitemap' => ! empty($routes['sitemap']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=red;options=bold>Route</> theme' => ! empty($routes['theme']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=red;options=bold>Route</> welcome' => ! empty($routes['welcome']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',

            'Package' => $this->package,
            'Version' => $version,
        ]);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            sprintf('%1$s/config/%2$s.php', dirname(__DIR__), $this->package),
            $this->package
        );
    }

    /**
     * @param array<string, bool> $routes
     */
    public function routes(array $routes): void
    {
        if (! empty($routes['about'])) {
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/about.php');
        }
        if (! empty($routes['bootstrap'])) {
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/bootstrap.php');
        }
        if (! empty($routes['dashboard'])) {
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/dashboard.php');
        }
        if (! empty($routes['home'])) {
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/home.php');
        }
        if (! empty($routes['index'])) {
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/index.php');
        }
        if (! empty($routes['sitemap'])) {
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/sitemap.php');
        }
        if (! empty($routes['theme'])) {
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/theme.php');
        }
        if (! empty($routes['welcome'])) {
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/welcome.php');
        }
    }

    public function version(): string
    {
        return static::VERSION;
    }
}
