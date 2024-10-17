<?php

use Illuminate\Support\Facades\Route;

Route::post('oauth/token', [
    'uses' => '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken',
    'as' => 'token',
]);
