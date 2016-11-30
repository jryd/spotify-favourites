<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RetrieveStatsController extends Controller
{
    public function retrieveData(\GuzzleHttp\Client $httpClient)
    {
        $response = $httpClient->get('https://api.spotify.com/v1/me/top/'.$_GET['type'].'?time_range='.$_GET['time_range'], [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . session('spotify_token'),
            ],
        ]);
        //dd(json_encode(json_decode($response->getBody())->items));
        return response()->json(json_decode($response->getBody())->items);
    }
    
    public function viewStats()
    {
        return view('mystats');
    }   
}
