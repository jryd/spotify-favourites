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

Route::get('/login/refresh', 'AuthenticateSpotifyController@spotifyRefresh');

Route::get('/mystatsdata', 'RetrieveStatsController@retrieveData');

Route::get('/mystats', 'RetrieveStatsController@viewStats');
