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

Route::get('/login/spotify', 'AuthenticateSpotifyController@spotifyLogin')->name('login');
Route::get('/callback', 'AuthenticateSpotifyController@spotifyCallback');
Route::get('/denied', 'AuthenticateSpotifyController@denied');
Route::get('/login/refresh', 'AuthenticateSpotifyController@spotifyRefresh');

Route::get('/favourites', 'RetrieveStatsController@viewStats')->name('favourites');

Route::get('/dashboard', function () {
	return 'placeholder';
})->name('dashboard');



Route::get('/myfavouritesdata', 'RetrieveStatsController@retrieveData');
Route::get('/analysedtrackdata', 'RetrieveStatsController@retrieveAnalysedTrackData');
