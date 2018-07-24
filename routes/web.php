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
  return View::make('welcome')->with('title', 'Welcome!');
})->name('welcome');

Route::post('/register', 'AuthController@register')->name('register');

Route::post('/login', 'AuthController@login')->name('login');

Route::group(['middleware' => ['checkuuid']], function () {

  Route::get('/profile/{uuid}', 'ProfileController@get')->name('profile_view');

  Route::get('/profile', 'ProfileController@me')->name('profile');

  Route::post('/account_setup/location', 'ProfileController@setLocation')->name('account_setup.location');

  Route::post('/account_setup/information', 'ProfileController@setInformation')->name('account_setup.information');

  Route::post('/account_setup/interest', 'ProfileController@setInterest')->name('account_setup.interest');

  Route::get('/account_setup', 'ProfileController@getAccountSetupView')->name('account_setup');

  Route::post('/search_matches', 'SearchController@search_matches')->name('search_matches');

  Route::get('/find_friends', 'SearchController@find_friends')->name('find_friends');

  Route::post('/change_cover_image', 'ProfileController@changeCoverImage')->name('change.cover_image');

  Route::post('/change_avatar', 'ProfileController@changeAvatar')->name('change.avatar');

  Route::get('/test', 'TestController@index');

  Route::post('/request/update', 'RequestController@update')->name('request.update');

  Route::post('/request/add', 'RequestController@add')->name('request.add');

  Route::post('/request/remove', 'RequestController@remove')->name('request.remove');

  Route::post('/request/accept', 'RequestController@accept')->name('request.accept');

  Route::post('/request/deny', 'RequestController@deny')->name('request.deny');

  Route::get('/messages', 'MessageController@index')->name('messages');

  Route::get('/photos/{uuid}', 'PhotoController@getPhotoView')->name('photos_view');

  Route::post('/photos/create_album', 'PhotoController@createAlbum')->name('photos.create_album');

  Route::post('/photos/upload', 'PhotoController@upload')->name('photos.upload');

});

// Keep at bottom
// Prevents snooping around through links
// Route::redirect('/{any}', '/')->where('any', '[\s\S]*');

?>
