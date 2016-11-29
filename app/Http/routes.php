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

Route::get('/login/spotify', function(){
    return Socialite::with('spotify')
        ->scopes(['user-top-read'])
        ->redirect();
});

Route::get('/callback', function(\GuzzleHttp\Client $httpClient){
    $response = $httpClient->post('https://accounts.spotify.com/api/token', [
        'form_params' => [
            'client_id' => env('SPOTIFY_KEY'),
            'client_secret' => env('SPOTIFY_SECRET'),
            'grant_type' => 'authorization_code',
            'code' => $_GET['code'],
            'redirect_uri' => env('SPOTIFY_REDIRECT_URI'),
        ]
    ]);
    $token = json_decode($response->getBody())->access_token;
    echo "Your Spotify Token is: ". $token. " place it inside your .env as SPOTIFY_TOKEN";
});

Route::get('/mystats', function(\GuzzleHttp\Client $httpClient) {
     $response = $httpClient->get('https://api.spotify.com/v1/me/top/'.$_GET['type'], [
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . env('SPOTIFY_TOKEN'),
        ],
    ]);
    
    dd(json_decode($response->getBody()));
});
