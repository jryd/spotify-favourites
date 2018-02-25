<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        if (isset($_GET['error']))
        {
            return redirect('/denied');
        }

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
        return redirect('/favourites');
    }

    public function denied()
    {
        return view('denied');
    }
}
