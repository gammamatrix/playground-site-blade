<?php

declare(strict_types=1);
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
 * \Playground\Site\Blade\Http\Controllers\HomeController
 */
class HomeController extends Controller
{
    /**
     * Display the home view.
     *
     * @route GET /home home
     */
    public function index(Request $request): JsonResponse|RedirectResponse|View
    {
        $this->init($request);

        if ($request->expectsJson()) {
            $payload = $this->response_payload($request);

            return response()->json($payload);
        }

        return view($this->getPackageViewPathFromConfig(
            $this->package_config_site_blade,
            'home',
            'index'
        ), [
            'package_config_site_blade' => $this->package_config_site_blade,
        ]);
    }
}
