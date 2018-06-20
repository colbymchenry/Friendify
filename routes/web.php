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

Route::get('/profile/{uuid}', 'ProfileController@make');

Route::get('/interests_setup', 'IndexController@interests_setup');

Route::post('/register', 'AuthController@register')->name('register');

Route::get('/test', 'TestController@index');

// Keep at bottom
// Prevents snooping around through links
// Route::redirect('/{any}', '/')->where('any', '[\s\S]*');

?>
