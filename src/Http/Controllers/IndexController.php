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
 * \Playground\Http\Controllers\IndexController
 */
class IndexController extends Controller
{
    /**
     * Display the index view
     *
     * @route GET /index index
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
            'index',
            'index'
        ), [
            'package_config_site_blade' => $this->package_config_site_blade,
        ]);
    }
}