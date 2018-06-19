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

<<<<<<< HEAD
Route::get('/index', 'IndexController@index');
=======
Route::get('/profile/{uuid}', 'ProfileController@make');
>>>>>>> d8226279f45eca51a90d455102bc736585ea5b98

Route::get('/interests_setup', 'IndexController@interests_setup');

Route::post('/register', 'AuthController@register')->name('register');

// Keep at bottom
// Prevents snooping around through links
// Route::redirect('/{any}', '/')->where('any', '[\s\S]*');
