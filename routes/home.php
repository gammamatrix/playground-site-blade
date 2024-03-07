<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
|
*/

Route::group([
    'middleware' => config('playground-site-blade.middleware.home'),
    'namespace' => '\Playground\Site\Blade\Http\Controllers',
], function () {
    Route::get('/home', [
        'as' => 'home',
        'uses' => 'HomeController@index',
    ]);
});
