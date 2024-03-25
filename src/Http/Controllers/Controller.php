<?php

declare(strict_types=1);
/**
 * Playground
 */
namespace Playground\Site\Blade\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;

/**
 * \Playground\Site\Blade\Http\Controllers\Controller
 */
abstract class Controller extends BaseController
{
    // use DispatchesJobs;
    use AuthorizesRequests;
    use ConcernsSnippets;
    use ValidatesRequests;

    /**
     * @var array<string, mixed>
     */
    protected array $package_config_site_blade;

    /**
     * @return array<string, mixed>
     */
    protected function response_payload(Request $request): array
    {
        $payload = [
            'data' => [],
            'meta' => [
                'timestamp' => Carbon::now()->toJson(),
            ],
            'package_config_site_blade' => $this->package_config_site_blade,
        ];

        return $payload;
    }

    public function getPackageViewPathFromConfig(
        mixed $config,
        string $controller,
        string $view
    ): string {
        $basePath = '';
        if (! empty($config)
            && is_array($config)
            && ! empty($config['view'])
            && is_string($config['view'])
        ) {
            $basePath = $config['view'];
        }

        return sprintf('%1$s%2$s.%3$s', $basePath, $controller, $view);
    }

    protected function init(Request $request = null): void
    {
        $package_config_site_blade = config('playground-site-blade');
        if (is_array($package_config_site_blade)) {
            $this->package_config_site_blade = $package_config_site_blade;
        }
    }
}
