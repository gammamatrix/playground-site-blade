<?php
/**
 * Playground
 */
namespace Playground\Site\Blade\Http\Controllers;

use Illuminate\Http\JsonResponse;
// use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * \Playground\Http\Controllers\IndexController
 */
class WelcomeController extends Controller
{
    /**
     * Display the welcome view.
     *
     * @route GET /welcome welcome
     */
    public function index(Request $request): JsonResponse|View
    {
        $this->init($request);

        if ($request->expectsJson()) {
            $payload = $this->response_payload($request);

            return response()->json($payload);
        }

        $package_config_site_blade = config('playground-site-blade');

        return view($this->getPackageViewPathFromConfig(
            $package_config_site_blade,
            'welcome',
            'index'
        ), [
            'package_config_site_blade' => $this->package_config_site_blade,
        ]);
    }
}
