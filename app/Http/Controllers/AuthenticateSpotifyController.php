<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Socialite;

class AuthenticateSpotifyController extends Controller
{
    public function spotifyLogin()
    {
        return Socialite::with('spotify')
        ->scopes(['user-top-read'])
        ->redirect();
    }
    
    public function spotifyCallback(\GuzzleHttp\Client $httpClient)
    {
        $response = $httpClient->post('https://accounts.spotify.com/api/token', [
            'form_params' => [
                'client_id' => env('SPOTIFY_KEY'),
                'client_secret' => env('SPOTIFY_SECRET'),
                'grant_type' => 'authorization_code',
                'code' => $_GET['code'],
                
                'redirect_uri' => env('SPOTIFY_REDIRECT_URI'),
            ]
        ]);
        
        session(['spotify_token' => json_decode($response->getBody())->access_token]);
        session(['spotify_refresh' => json_decode($response->getBody())->refresh_token]);
        return redirect('/mystats');
        /*$access_token = json_decode($response->getBody())->access_token;
        $refresh_token = json_decode($response->getBody())->refresh_token;
        echo "Your Spotify Token is: ". $access_token. " place it inside your .env as SPOTIFY_TOKEN <br> Your Refresh Token is: " . $refresh_token . " place it in your .env as SPOTIFY_REFRESH";*/
    }
    
    public function spotifyRefresh(\GuzzleHttp\Client $httpClient)
    {
        $response = $httpClient->post('https://accounts.spotify.com/api/token', [
            'form_params' => [
                'client_id' => env('SPOTIFY_KEY'),
                'client_secret' => env('SPOTIFY_SECRET'),
                'grant_type' => 'authorization_code',
                'code' => env('SPOTIFY_REFRESH'),
                'redirect_uri' => env('SPOTIFY_REDIRECT_URI'),
            ]
        ]);
        $token = json_decode($response->getBody())->access_token;
        echo "Your new Spotify Token is: ". $token. " place it inside your .env as SPOTIFY_TOKEN";
    }
}
