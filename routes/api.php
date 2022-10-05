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

Route::get('login', 'AuthController@getAuthUrl');
Route::get('postLogin', 'AuthController@postLogin');
Route::get('getUserClient', 'AuthController@getUserClient');
Route::middleware(['auth:api'])->group(function () {
    Route::get('todo/get', 'TodoController@get');
    Route::post('todo', 'TodoController@create');
    Route::post('todo/{id}', 'TodoController@markComplete');
    Route::delete('todo/{id}', 'TodoController@delete');
});


