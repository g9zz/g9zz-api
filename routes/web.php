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

//Route::group(['middleware' => ['g9zz']],function(){

//$this->get('login', 'Auth\MyLoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\MyLoginController@login');
$this->post('logout', 'Auth\MyLoginController@logout')->name('logout');
//});
// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\MyRegisterController@store')->name('register.store');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

//\Illuminate\Support\Facades\Auth::routes();
Route::get('auth/{service}', 'Auth\MyLoginController@redirectToProvider');
Route::get('auth/{service}/callback', 'Auth\MyLoginController@handleProviderCallback');


Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'post'],function() {
    Route::get('/','Console\PostController@index')->name('console.post.index');
    Route::get('/{hid}','Console\PostController@show')->name('console.post.show');
});

Route::group(['prefix' => 'node'],function() {
    Route::get('/','Console\NodeController@index')->name('console.node.index');
    Route::get('/{hid}','Console\NodeController@show')->name('console.node.show');
});

Route::group(['prefix' => 'tag'],function() {
    Route::get('/','Console\TagController@index')->name('console.tag.index');
    Route::get('/{hid}','Console\TagController@show')->name('console.tag.show');
});

Route::group(['prefix' => 'reply'],function() {
    Route::get('/','Index\ReplyController@index')->name('console.reply.index');
    Route::get('/{hid}','Index\ReplyController@show')->name('console.reply.show');
});

Route::group(['prefix' => 'append'],function() {
    Route::get('/','Index\AppendController@index')->name('console.append.index');
    Route::post('/','Index\AppendController@store')->name('console.append.store');
    Route::get('/{hid}','Index\AppendController@show')->name('console.append.show');
//    Route::put('/{id}','Index\AppendController@update')->name('console.append.put');
//    Route::delete('/{id}','Index\AppendController@destroy')->name('console.append.destroy');
});


