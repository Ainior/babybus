<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function () {

});

Route::prefix('user')->group(function () {
    Route::get('post/list', 'UserController@post_list');

    Route::get('info/{id}', 'UserController@info');
    Route::post('create', 'UserController@create');
    Route::delete('delete/{id}', 'UserController@delete');
    Route::put('update/{id}', 'UserController@update');
});
Route::prefix('post')->group(function () {
    Route::post('like', 'PostController@like');
    Route::get('like/list', 'PostController@like_list');

    Route::get('info/{id}', 'PostController@info');
    Route::post('create', 'PostController@create');
    Route::delete('delete/{id}', 'PostController@delete');
    Route::put('update/{id}', 'PostController@update');
});
