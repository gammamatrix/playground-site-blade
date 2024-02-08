<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Sitemap Routes
|--------------------------------------------------------------------------
|
*/

Route::group([
    'middleware' => config('playground-site-blade.middleware.sitemap'),
    'namespace' => '\Playground\Site\Blade\Http\Controllers',
], function () {
    Route::get('/sitemap', [
        'as' => 'sitemap',
        'uses' => 'SitemapController@index',
    ]);
});
