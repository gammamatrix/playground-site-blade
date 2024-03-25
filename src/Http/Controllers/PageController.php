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
use Playground\Cms\Models\Page;

/**
 * \Playground\Site\Blade\Http\Controllers\PageController
 */
class PageController extends Controller
{
    use ConcernsPages;

    protected string $snippet_slug = 'playground-site-blade::page';

    /**
     * Display a page from the CMS.
     *
     * @route GET /{slug} page
     */
    public function page(Request $request, string $slug): JsonResponse|RedirectResponse|View
    {
        $this->init($request);

        $page = $this->pageBySlug($request, $slug);

        if (empty($page)) {
            abort(404);
        }

        /**
         * @var array<int, array<string, mixed>>
         */
        $snippets = $this->snippetsForRoute($request);

        if ($request->expectsJson()) {
            $payload = $this->response_payload($request);

            $payload['data'] = $page;
            $payload['snippets'] = $snippets;

            return response()->json($payload);
        }

        return view($this->getPackageViewPathFromConfig(
            $this->package_config_site_blade,
            'page',
            'page'
        ), [
            'package_config_site_blade' => $this->package_config_site_blade,
            'snippets' => $snippets,
            'data' => $page,
        ]);
    }
}
