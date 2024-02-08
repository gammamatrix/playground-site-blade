<?php
/**
 * Playground
 */
namespace Playground\Site\Blade\Http\Controllers;

use Illuminate\Http\JsonResponse;
// use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * \Playground\Http\Controllers\SitemapController
 */
class SitemapController extends Controller
{
    protected bool $enable = true;

    protected bool $enableGuest = true;

    protected bool $enableUser = true;

    protected string $viewBase;

    /**
     * @var array<string, mixed>
     */
    protected array $configs;

    /**
     * @var array<string, mixed>
     */
    protected array $sitemaps;

    /**
     * Display the sitemap view.
     *
     * @route GET /sitemap sitemap
     */
    public function index(Request $request): JsonResponse|RedirectResponse|View
    {
        $this->init($request);

        // Is the sitemap enabled?
        if (! $this->enable) {
            abort_if($request->has('noredirect'), 404);

            return redirect('/');
        }

        $user = $request->user();

        // Is the sitemap enabled for guests?
        if (! $this->enableGuest && empty($user)) {
            abort_if($request->has('noredirect'), 401);

            return redirect('/');
        }

        // Prepare package configurations to load sitemaps.
        $this->configs();

        // Prepare sitemaps for the UI
        $this->sitemaps();

        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '__FILE__' => __FILE__,
        //     '__LINE__' => __LINE__,
        //     '$configs' => $configs,
        //     '$sitemaps' => $sitemaps,
        // ]);

        return view($this->viewBase, [
            'package_config_site_blade' => $this->package_config_site_blade,
            'configs' => $this->configs,
            'sitemaps' => $this->sitemaps,
            // 'snippets' => $this->snippetsForRoute($request),
        ]);
    }

    protected function init(Request $request = null): void
    {
        parent::init($request);

        if (! empty($this->package_config_site_blade['sitemap'])
            && is_array($this->package_config_site_blade['sitemap'])
        ) {
            $this->enable = ! empty($this->package_config_site_blade['sitemap']['enable']);
            $this->enableGuest = ! empty($this->package_config_site_blade['sitemap']['guest']);
            $this->enableUser = ! empty($this->package_config_site_blade['sitemap']['user']);

            if (! empty($this->package_config_site_blade['sitemap']['view'])
                && is_string($this->package_config_site_blade['sitemap']['view'])
            ) {
                $this->viewBase = $this->package_config_site_blade['sitemap']['view'];
            } else {
                $this->viewBase = $this->getPackageViewPathFromConfig(
                    $this->package_config_site_blade,
                    'sitemap',
                    'index'
                );
            }
        }
    }

    protected function configs(): void
    {
        $this->configs = [];
        if (! empty($this->package_config['packages']) && is_array($this->package_config['packages'])) {
            foreach ($this->package_config['packages'] as $package) {
                if (is_string($package) && ! empty($package) && ! array_key_exists($package, $this->configs)) {
                    $this->configs[$package] = config($package);
                }
            }
        }
    }

    protected function sitemaps(): void
    {
        $this->sitemaps = [];

        foreach ($this->configs as $package => $config) {
            if ($package && is_string($package) && is_array($config)
                && ! empty($config['sitemap'])
                && is_array($config['sitemap'])
                && ! empty($config['sitemap']['enable'])
                && is_array($config['load'])
                && ! empty($config['load']['views'])
            ) {
                $this->sitemaps[$package] = $config['sitemap'];
            }
        }
    }
}
