<?php
/**
 * Playground
 */
namespace Playground\Site\Blade\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * \Playground\Http\Controllers\BootstrapController
 */
class BootstrapController extends Controller
{
    /**
     * Display the Bootstrap theme view for UI component development previews.
     *
     * @route GET /bootstrap bootstrap
     */
    public function index(Request $request): View
    {
        $this->init($request);

        return view($this->getPackageViewPathFromConfig(
            $this->package_config_site_blade,
            'bootstrap',
            'index'
        ), [
            'package_config_site_blade' => $this->package_config_site_blade,
        ]);
    }

    /**
     * Handle the Bootstrap theme for the session.
     *
     * @route GET /theme theme
     */
    public function theme(Request $request): RedirectResponse|View
    {
        $this->init($request);

        $appTheme = $request->input('appTheme');
        $_return_url = $request->input('_return_url');

        if ($request->has('preview')) {
            return view($this->getPackageViewPathFromConfig(
                $this->package_config_site_blade,
                'bootstrap',
                'theme'
            ), [
                'package_config_site_blade' => $this->package_config_site_blade,
            ]);
        }

        session([
            'appTheme' => is_string($appTheme) ? $appTheme : '',
        ]);

        $_return_url = empty($_return_url) || ! is_string($_return_url) ? '/' : $_return_url;

        return redirect($_return_url);
    }
}
