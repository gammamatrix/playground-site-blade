<?php

declare(strict_types=1);
/**
 * Playground
 */
namespace Playground\Site\Blade\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Playground\Blade\Facades\Ui;

/**
 * \Playground\Site\Blade\Http\Controllers\BootstrapController
 */
class BootstrapController extends Controller
{
    protected string $snippet_slug = 'playground-site-blade::bootstrap';

    /**
     * Display the Bootstrap theme view for UI component development previews.
     *
     * @route GET /bootstrap bootstrap
     */
    public function index(Request $request): View
    {
        $this->init($request);

        $wildcard = true;
        if ($request->has('wildcard') && ! $request->input('wildcard')) {
            $wildcard = false;
        }

        return view($this->getPackageViewPathFromConfig(
            $this->package_config_site_blade,
            'bootstrap',
            'index'
        ), [
            'snippets' => $this->snippetsForRoute($request, [
                'wildcard' => $wildcard,
            ]),
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
        $appTheme = is_string($appTheme) ? $appTheme : '';

        $save = ! $request->has('preview');

        $wildcard = true;
        if ($request->has('wildcard') && ! $request->input('wildcard')) {
            $wildcard = false;
        }

        $_return_url = $request->input('_return_url');

        Ui::setTheme($appTheme, $save);

        if ($request->has('preview')) {
            return view($this->getPackageViewPathFromConfig(
                $this->package_config_site_blade,
                'bootstrap',
                'theme'
            ), [
                'snippets' => $this->snippetsForRoute($request, [
                    'wildcard' => $wildcard,
                ]),
                'package_config_site_blade' => $this->package_config_site_blade,
            ]);
        }

        $_return_url = empty($_return_url) || ! is_string($_return_url) ? '/' : $_return_url;

        return redirect($_return_url);
    }
}
