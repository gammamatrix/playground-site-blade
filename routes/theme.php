<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Theme Handling Routes
|--------------------------------------------------------------------------
|
*/

Route::group([
    'middleware' => config('playground-site-blade.middleware.default'),
    'namespace' => '\Playground\Site\Blade\Http\Controllers',
], function () {
    Route::get('/theme', [
        'as' => 'theme',
        'uses' => 'BootstrapController@theme',
    ]);
});
