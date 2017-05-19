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
    Route::post('/{userId}/role/{roleId}','Console\UserController@attachRole')->name('console.user.attach.role');
});

Route::group(['prefix' => 'post'],function() {
    Route::get('/','Console\PostController@index')->name('console.post.index');
    Route::post('/','Console\PostController@store')->name('console.post.store');
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

Route::group(['prefix' => 'reply'],function() {
    Route::get('/','Index\ReplyController@index')->name('console.reply.index');
    Route::post('/','Index\ReplyController@store')->name('console.reply.store');
    Route::get('/{id}','Index\ReplyController@show')->name('console.reply.show');
    Route::put('/{id}','Index\ReplyController@update')->name('console.reply.put');
    Route::delete('/{id}','Index\ReplyController@destroy')->name('console.reply.destroy');
});

Route::group(['prefix' => 'append'],function() {
    Route::get('/','Index\AppendController@index')->name('console.append.index');
    Route::post('/','Index\AppendController@store')->name('console.append.store');
    Route::get('/{id}','Index\AppendController@show')->name('console.append.show');
//    Route::put('/{id}','Index\AppendController@update')->name('console.append.put');
//    Route::delete('/{id}','Index\AppendController@destroy')->name('console.append.destroy');
});

Route::group(['prefix' => 'permission'],function() {
    Route::get('/','Console\PermissionController@index')->name('console.permission.index');
    Route::post('/','Console\PermissionController@store')->name('console.permission.store');
    Route::get('/{id}','Console\PermissionController@show')->name('console.permission.show');
    Route::put('/{id}','Console\PermissionController@update')->name('console.permission.put');
    Route::delete('/{id}','Console\PermissionController@destroy')->name('console.permission.destroy');
});

Route::group(['prefix' => 'role'],function() {
    Route::get('/','Console\RoleController@index')->name('console.role.index');
    Route::post('/','Console\RoleController@store')->name('console.role.store');
    Route::get('/{id}','Console\RoleController@show')->name('console.role.show');
    Route::put('/{id}','Console\RoleController@update')->name('console.role.put');
    Route::delete('/{id}','Console\RoleController@destroy')->name('console.role.destroy');

    Route::post('/{roleId}/permission','Console\RoleController@attachPermission')->name('console.role.attach.permission');

});

Route::group(['prefix' => 'code'],function() {
    Route::get('/','Console\InviteCodeController@index')->name('console.code.store');
    Route::get('/allCode','Console\InviteCodeController@getAllCode')->name('console.code.all.code');
    Route::post('/','Console\InviteCodeController@store')->name('console.code.store');
});