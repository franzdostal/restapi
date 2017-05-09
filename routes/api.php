<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// 'middleware' => 'auth:api'
Route::group([], function()
{
    Route::resource('/users', 'UserController',
        ['only' => ['index', 'store', 'destroy', 'show']]);

    Route::resource('/tasks', 'TaskController',
        ['only' => ['index', 'store', 'destroy', 'show', 'update']]);

    Route::get('/email-verification/{token}', 'UserController@emailVerification');

});
