<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Bootstrap Theme Routes
|--------------------------------------------------------------------------
|
*/

Route::group([
    'middleware' => config('playground-site-blade.middleware.default'),
    'namespace' => '\Playground\Site\Blade\Http\Controllers',
], function () {
    Route::get('/bootstrap', [
        'as' => 'bootstrap',
        'uses' => 'BootstrapController@index',
    ]);
});
