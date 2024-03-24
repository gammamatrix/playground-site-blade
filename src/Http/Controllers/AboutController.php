<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Site\Blade\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * \Playground\Site\Blade\Http\Controllers\AboutController
 */
class AboutController extends Controller
{
    protected string $snippet_slug = 'playground-site-blade::about';

    /**
     * Display the about view.
     *
     * @route GET /about about
     */
    public function index(Request $request): JsonResponse|View
    {
        $this->init($request);

        /**
         * @var array<int, array<string, mixed>>
         */
        $snippets = $this->snippetsForRoute($request);

        if ($request->expectsJson()) {
            $payload = $this->response_payload($request);

            $payload['snippets'] = $snippets;

            return response()->json($payload);
        }

        return view($this->getPackageViewPathFromConfig(
            $this->package_config_site_blade,
            'about',
            'index'
        ), [
            'package_config_site_blade' => $this->package_config_site_blade,
            'snippets' => $snippets,
        ]);
    }
}
