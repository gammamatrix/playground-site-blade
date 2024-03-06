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
    'dashboard' => [
        'enable' => (bool) env('PLAYGROUND_SITE_BLADE_DASHBOARD_ENABLE', true),
        'guest' => (bool) env('PLAYGROUND_SITE_BLADE_DASHBOARD_GUEST', true),
        'user' => (bool) env('PLAYGROUND_SITE_BLADE_DASHBOARD_USER', true),
        // 'view' => env('PLAYGROUND_SITE_BLADE_DASHBOARD_VIEW', 'playground-site::dashboard.index'),
        'view' => env('PLAYGROUND_SITE_BLADE_DASHBOARD_VIEW', ''),
    ],
    'sitemap' => [
        'enable' => (bool) env('PLAYGROUND_SITE_BLADE_SITEMAP_ENABLE', true),
        'guest' => (bool) env('PLAYGROUND_SITE_BLADE_SITEMAP_GUEST', true),
        'user' => (bool) env('PLAYGROUND_SITE_BLADE_SITEMAP_USER', true),
        'view' => env('PLAYGROUND_SITE_BLADE_SITEMAP_VIEW', 'playground-site::sitemap'),
    ],
    'view' => env('PLAYGROUND_SITE_BLADE_VIEW', 'playground-site::'),
];
