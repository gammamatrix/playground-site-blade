<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Welcome Routes
|--------------------------------------------------------------------------
|
*/

Route::group([
    'middleware' => config('playground-site-blade.middleware.welcome'),
    'namespace' => '\Playground\Site\Blade\Http\Controllers',
], function () {
    Route::get('/welcome', [
        'as' => 'welcome',
        'uses' => 'WelcomeController@index',
    ]);
});
