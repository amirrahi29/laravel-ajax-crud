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

Route::get('/', 'App\Http\Controllers\UserController@index');
Route::get('/edit_user/{id}', 'App\Http\Controllers\UserController@edit_user');

Route::post('add_user_form_submit','App\Http\Controllers\UserController@add_user_form_submit');
Route::get('/delete_user/{id}', 'App\Http\Controllers\UserController@delete_user');
Route::post('/update_user_form_submit','App\Http\Controllers\UserController@update_user_form_submit');