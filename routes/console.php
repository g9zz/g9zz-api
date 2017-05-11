<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

//Route::resource('user','Console\UserController');
Route::group(['prefix' => 'user'],function(){
    Route::get('/','Console\UserController@index')->name('console.user.index');
});

Route::group(['prefix' => 'post'],function() {
    Route::get('/','Console\PostController@index')->name('console.post.index');
    Route::get('/{id}','Console\PostController@show')->name('console.post.show');
    Route::put('/{id}','Console\PostController@update')->name('console.post.put');
    Route::delete('/{id}','Console\PostController@destroy')->name('console.post.destroy');
});

Route::group(['prefix' => 'node'],function() {
    Route::get('/','Console\NodeController@index')->name('console.node.index');
    Route::post('/','Console\NodeController@store')->name('console.node.store');
    Route::get('/{id}','Console\NodeController@show')->name('console.node.show');
    Route::put('/{id}','Console\NodeController@update')->name('console.node.put');
    Route::delete('/{id}','Console\NodeController@destroy')->name('console.node.destroy');
});

Route::group(['prefix' => 'tag'],function() {
    Route::get('/','Console\TagController@index')->name('console.tag.index');
    Route::post('/','Console\TagController@store')->name('console.tag.store');
    Route::get('/{id}','Console\TagController@show')->name('console.tag.show');
    Route::put('/{id}','Console\TagController@update')->name('console.tag.put');
    Route::delete('/{id}','Console\TagController@destroy')->name('console.tag.destroy');
});