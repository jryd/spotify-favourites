<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RetrieveStatsController extends Controller
{
    public function retrieveData(\GuzzleHttp\Client $httpClient)
    {
        try {
            $response = $httpClient->get('https://api.spotify.com/v1/me/top/'.$_GET['type'].'?time_range='.$_GET['time_range'], [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . session('spotify_token'),
                ],
            ]);

            return response()->json(json_decode($response->getBody())->items);
        } catch (\Exception $e) {
            
            $refreshToken = $httpClient->post('https://accounts.spotify.com/api/token', [
                'form_params' => [
                    'client_id' => env('SPOTIFY_KEY'),
                    'client_secret' => env('SPOTIFY_SECRET'),
                    'grant_type' => 'refresh_token',
                    'refresh_token' => session('spotify_refresh'),
                    'redirect_uri' => env('SPOTIFY_REDIRECT_URI'),
                ]
            ]);
            
            $refreshToken = json_decode($refreshToken->getBody());
            
            session(['spotify_token' => $refreshToken->access_token]);
            
            if (isset($refreshToken->refresh_token))
            {
                session(['spotify_refresh' => $refreshToken->refresh_token]);
            }
            
            $response = $httpClient->get('https://api.spotify.com/v1/me/top/'.$_GET['type'].'?time_range='.$_GET['time_range'], [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . session('spotify_token'),
                ],
            ]);

            return response()->json(json_decode($response->getBody())->items);
        }
    }
    
    public function viewStats()
    {
        if (session()->has('spotify_token'))
        {
            return view('mystats');
        }
        
        return redirect('/login/spotify');
    }
    
    public function retrieveAnalysedTrackData(\GuzzleHttp\Client $httpClient)
    {
        $response = $httpClient->get('https://api.spotify.com/v1/audio-features/'.$_GET['track'], [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . session('spotify_token'),
            ],
        ]);

        return response()->json(json_decode($response->getBody()));
    }
}
