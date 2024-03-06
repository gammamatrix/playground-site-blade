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
    'middleware' => config('playground-site-blade.middleware.default'),
    'namespace' => '\Playground\Site\Blade\Http\Controllers',
], function () {
    Route::get('/', [
        'as' => 'index',
        'uses' => 'IndexController@index',
    ]);
});
