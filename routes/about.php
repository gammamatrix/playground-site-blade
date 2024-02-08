<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| About Routes
|--------------------------------------------------------------------------
|
*/

Route::group([
    'middleware' => config('playground-site-blade.middleware.default'),
    'namespace' => '\Playground\Site\Blade\Http\Controllers',
], function () {
    Route::get('/about', [
        'as' => 'about',
        'uses' => 'AboutController@index',
    ]);
});
