<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\ProductController@index');
Route::get('/single/{id}', 'App\Http\Controllers\ProductController@single');
Route::get('/registration/', 'App\Http\Controllers\ProductController@registration');
Route::get('/signin/', 'App\Http\Controllers\ProductController@signin');


