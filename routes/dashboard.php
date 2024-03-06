<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
*/

Route::group([
    'middleware' => config('playground-site-blade.middleware.dashboard'),
    'namespace' => '\Playground\Site\Blade\Http\Controllers',
], function () {
    Route::get('/dashboard', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@index',
    ]);
});
