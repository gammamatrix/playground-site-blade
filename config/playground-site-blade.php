<?php

declare(strict_types=1);

return [
    'layout' => env('PLAYGROUND_SITE_BLADE_LAYOUT', env('PLAYGROUND_BLADE_LAYOUT', 'playground::layouts.site')),

    'load' => [
        'views' => (bool) env('PLAYGROUND_SITE_BLADE_LOAD_VIEWS', true),
        'routes' => (bool) env('PLAYGROUND_SITE_BLADE_LOAD_ROUTES', true),
    ],

    'middleware' => [
        'default' => env('PLAYGROUND_SITE_BLADE_MIDDLEWARE_DEFAULT', 'web'),
        'dashboard' => env('PLAYGROUND_SITE_BLADE_MIDDLEWARE_DASHBOARD', ['web', 'auth']),
        'home' => env('PLAYGROUND_SITE_BLADE_MIDDLEWARE_HOME', ['web', 'auth']),
        'sitemap' => env('PLAYGROUND_SITE_BLADE_MIDDLEWARE_SITEMAP', 'web'),
        'welcome' => env('PLAYGROUND_SITE_BLADE_MIDDLEWARE_WELCOME', 'web'),
    ],

    'routes' => [
        'about' => (bool) env('PLAYGROUND_SITE_BLADE_ROUTES_ABOUT', true),
        'bootstrap' => (bool) env('PLAYGROUND_SITE_BLADE_ROUTES_BOOTSTRAP', true),
        'dashboard' => (bool) env('PLAYGROUND_SITE_BLADE_ROUTES_DASHBOARD', true),
        'home' => (bool) env('PLAYGROUND_SITE_BLADE_ROUTES_HOME', true),
        'index' => (bool) env('PLAYGROUND_SITE_BLADE_ROUTES_INDEX', true),
        'sitemap' => (bool) env('PLAYGROUND_SITE_BLADE_ROUTES_SITEMAP', true),
        'theme' => (bool) env('PLAYGROUND_SITE_BLADE_ROUTES_THEME', true),
        'welcome' => (bool) env('PLAYGROUND_SITE_BLADE_ROUTES_WELCOME', true),
    ],

    'view' => env('PLAYGROUND_SITE_BLADE_VIEW', 'playground-site::'),

    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | Caching is disabled, in this package, by default.
    |
    | Caching may be enabled for both pages and snippets separately.
    |
    | The default store is set to file.
    |
    | The default TTL for both pages and snippets is set for 15 minutes.
    |
    */

    'cache' => [
        'enable' => (bool) env('PLAYGROUND_SITE_BLADE_CACHE_ENABLE', false),
        // 'enable' => true,

        'page' => (bool) env('PLAYGROUND_SITE_BLADE_CMS_CACHE_PAGE', true),
        'page_store' => env('PLAYGROUND_SITE_BLADE_CMS_CACHE_PAGE_STORE', 'file'),
        'page_ttl' => env('PLAYGROUND_SITE_BLADE_CMS_CACHE_PAGE_TTL', 60 * 15),

        'snippet' => (bool) env('PLAYGROUND_SITE_BLADE_CMS_CACHE_SNIPPET', true),
        'snippet_store' => env('PLAYGROUND_SITE_BLADE_CMS_CACHE_SNIPPET_STORE', 'file'),
        'snippet_ttl' => env('PLAYGROUND_SITE_BLADE_CMS_CACHE_SNIPPET_TTL', 60 * 15),
    ],

    /*
    |--------------------------------------------------------------------------
    | CMS
    |--------------------------------------------------------------------------
    |
    | The CMS is disabled, in this package, by default.
    |
    */

    'cms' => [
        'enable' => (bool) env('PLAYGROUND_SITE_BLADE_CMS_ENABLE', false),
        // 'enable' => (bool) env('PLAYGROUND_SITE_BLADE_CMS_ENABLE', true),

        'page' => env('PLAYGROUND_SITE_BLADE_CMS_PAGE', Playground\Cms\Models\Page::class),
        'pages' => (bool) env('PLAYGROUND_SITE_BLADE_CMS_PAGES', true),

        'pages_user' => (bool) env('PLAYGROUND_SITE_BLADE_CMS_PAGES_USER', true),
        // 'pages_user' => false,

        'snippet' => env('PLAYGROUND_SITE_BLADE_CMS_SNIPPETS', Playground\Cms\Models\Snippet::class),
        'snippets' => (bool) env('PLAYGROUND_SITE_BLADE_CMS_SNIPPETS', true),
        'snippets_user' => (bool) env('PLAYGROUND_SITE_BLADE_CMS_SNIPPETS_USER', true),
        // 'snippets_user' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Domain
    |--------------------------------------------------------------------------
    |
    | Multiple domain handling for the site. Disabled by default.
    |
    | A route parameter key will need to be set to fetch: $request->input($key)
    |
    | @see https://laravel.com/docs/11.x/routing#route-group-subdomain-routing
    */

    'domain' => [
        'enable' => (bool) env('PLAYGROUND_SITE_BLADE_DOMAIN_ENABLE', false),
        'key' => env('PLAYGROUND_SITE_BLADE_DOMAIN_KEY', ''),
        'default' => env('PLAYGROUND_SITE_BLADE_DOMAIN_DEFAULT', 'www'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    |
    | The dashboard is enabled by default for users and guests.
    |
    | A custom view may be defined in PLAYGROUND_SITE_BLADE_DASHBOARD_VIEW
    |
    */

    'dashboard' => [
        'enable' => (bool) env('PLAYGROUND_SITE_BLADE_DASHBOARD_ENABLE', true),
        'guest' => (bool) env('PLAYGROUND_SITE_BLADE_DASHBOARD_GUEST', true),
        'user' => (bool) env('PLAYGROUND_SITE_BLADE_DASHBOARD_USER', true),
        // 'view' => env('PLAYGROUND_SITE_BLADE_DASHBOARD_VIEW', 'playground-site::dashboard.index'),
        'view' => env('PLAYGROUND_SITE_BLADE_DASHBOARD_VIEW', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Sitemap
    |--------------------------------------------------------------------------
    |
    | The sitemap is enabled by default for users and guests.
    |
    | A custom view may be defined in PLAYGROUND_SITE_BLADE_SITEMAP_VIEW.
    | - An empty value will disabled the sitemap.
    |
    |
    |
    */

    'sitemap' => [
        'enable' => (bool) env('PLAYGROUND_SITE_BLADE_SITEMAP_ENABLE', true),
        'guest' => (bool) env('PLAYGROUND_SITE_BLADE_SITEMAP_GUEST', true),
        'user' => (bool) env('PLAYGROUND_SITE_BLADE_SITEMAP_USER', true),
        'view' => env('PLAYGROUND_SITE_BLADE_SITEMAP_VIEW', 'playground-site::sitemap'),
    ],
];
