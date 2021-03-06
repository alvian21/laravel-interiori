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

Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@login')->name('login');

Route::group(['prefix' => 'admin', 'middelware' => 'CheckAuth'], function () {
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::resource('dashboard', 'DashboardController');
    Route::resource('user', 'UserController');
    Route::resource('designer', 'DesignerController');
});
