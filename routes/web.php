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

Route::post('/register', 'AuthController@register')->name('register');

Route::post('/login', 'AuthController@login')->name('login');

Route::group(['middleware' => ['checkemail']], function () {

  Route::get('/profile/{uuid}', 'ProfileController@make')->name('profile');

  Route::post('/search_matches', 'SearchController@search_matches')->name('search_matches');

  Route::post('/search_people', 'SearchController@search_people')->name('search_people');

  Route::post('/change_cover_image', 'ProfileController@changeCoverImage')->name('change.cover_image');

  Route::post('/change_avatar', 'ProfileController@changeAvatar')->name('change.avatar');

  Route::get('/test', 'TestController@index');

});

// Keep at bottom
// Prevents snooping around through links
// Route::redirect('/{any}', '/')->where('any', '[\s\S]*');

?>
