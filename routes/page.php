<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Index Routes
|--------------------------------------------------------------------------
|
*/

Route::group([
    'middleware' => config('playground-site-blade.middleware.page'),
    'namespace' => '\Playground\Site\Blade\Http\Controllers',
], function () {
    Route::get('/{slug}', [
        'as' => 'page',
        'uses' => 'PageController@page',
    ])->where('slug', '^([0-9A-Za-z\-\/]+)');
});
