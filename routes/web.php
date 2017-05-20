<?php

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

Route::get('/', function () {
    return view('welcome');
});

\Illuminate\Support\Facades\Auth::routes();

Route::get('auth/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{service}/callback', 'Auth\LoginController@handleProviderCallback');


Route::get('/home', 'HomeController@index');
