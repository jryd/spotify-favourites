<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login/spotify', 'AuthenticateSpotifyController@spotifyLogin');

Route::get('/callback', 'AuthenticateSpotifyController@spotifyCallback');

Route::get('/denied', 'AuthenticateSpotifyController@denied');

Route::get('/login/refresh', 'AuthenticateSpotifyController@spotifyRefresh');

Route::get('/myfavourites', 'RetrieveStatsController@viewStats');

Route::get('/myfavouritesdata', 'RetrieveStatsController@retrieveData');
Route::get('/analysedtrackdata', 'RetrieveStatsController@retrieveAnalysedTrackData');