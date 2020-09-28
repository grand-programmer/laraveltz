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

Route::post('/login', 'AuthController@login')->name('login');
Route::post('/register', 'UserController@store');
Route::get('/products', 'ProductController@index');
Route::get('/product/{id}', 'ProductController@show');
Route::get('/categories', 'CategoryController@index');
Route::get('/category/{id}', 'CategoryController@show');
Route::get('/users', 'UserController@index');
Route::middleware(['auth.jwt'])->group(function () {
    Route::get('/me', 'AuthController@me');
    Route::post('/category', 'CategoryController@store');
    Route::post('/product', 'ProductController@store');
    Route::post('/product/{id}', 'ProductController@update');
    Route::delete('/product/{id}', 'ProductController@destroy');
    Route::post('/category/{id}', 'CategoryController@update');
    Route::delete('/category/{id}', 'CategoryController@destroy');
});

