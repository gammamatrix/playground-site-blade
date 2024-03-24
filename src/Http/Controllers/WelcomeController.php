<?php

declare(strict_types=1);
/**
 * Playground
 */
namespace Playground\Site\Blade\Http\Controllers;

use Illuminate\Http\JsonResponse;
// use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * \Playground\Site\Blade\Http\Controllers\IndexController
 */
class WelcomeController extends Controller
{
    protected string $snippet_slug = 'playground-site-blade::welcome';

    /**
     * Display the welcome view.
     *
     * @route GET /welcome welcome
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
            'welcome',
            'index'
        ), [
            'package_config_site_blade' => $this->package_config_site_blade,
            'snippets' => $snippets,
        ]);
    }
}
