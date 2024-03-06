<?php

declare(strict_types=1);
/**
 * Playground
 */
namespace Playground\Site\Blade\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * \Playground\Site\Blade\Http\Controllers\DashboardController
 */
class DashboardController extends Controller
{
    protected bool $enable = true;

    protected bool $enableGuest = true;

    protected bool $enableUser = true;

    protected string $viewBase;

    /**
     * Display the dashboard view.
     *
     * @route GET /dashboard dashboard
     */
    public function index(Request $request): JsonResponse|RedirectResponse|View
    {
        $this->init($request);

        // Is the dashboard enabled?
        if (! $this->enable) {
            abort_if($request->has('noredirect'), 404);

            return redirect('/');
        }

        $user = $request->user();

        // Is the dashboard enabled for guests?
        if (! $this->enableGuest && empty($user)) {
            abort_if($request->has('noredirect'), 401);

            return redirect('/');
        }

        if ($request->expectsJson()) {
            $payload = $this->response_payload($request);

            return response()->json($payload);
        }

        return view($this->viewBase, [
            'package_config_site_blade' => $this->package_config_site_blade,
        ]);
    }

    protected function init(Request $request = null): void
    {
        parent::init($request);

        if (! empty($this->package_config_site_blade['dashboard'])
            && is_array($this->package_config_site_blade['dashboard'])
        ) {
            $this->enable = ! empty($this->package_config_site_blade['dashboard']['enable']);
            $this->enableGuest = ! empty($this->package_config_site_blade['dashboard']['guest']);
            $this->enableUser = ! empty($this->package_config_site_blade['dashboard']['user']);

            if (! empty($this->package_config_site_blade['dashboard']['view'])
                && is_string($this->package_config_site_blade['dashboard']['view'])
            ) {
                $this->viewBase = $this->package_config_site_blade['dashboard']['view'];
            } else {
                $this->viewBase = $this->getPackageViewPathFromConfig(
                    $this->package_config_site_blade,
                    'dashboard',
                    'index'
                );
            }
        }
    }
}
