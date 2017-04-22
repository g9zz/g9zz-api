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

});