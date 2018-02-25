@extends('layouts.layout')

@section('pageTitle')
Welcome
@endsection

@section('title')
Spotify Favourites
@endsection

@section('content')
<div class="max-w-md rounded overflow-hidden shadow-lg mx-auto mt-8 border bg-grey-lightest">
    <div class="py-6 px-4">
        <div class="font-bold text-xl pb-2">
            Hi!
        </div>
        <div>
            <p class="mb-2">Ever wondered what your top artists or tracks are on Spotify? Well, wonder no more!</p>
            <p class="mb-2">To get started, just click the button below - you will be taken to Spotify to authorise the application on your account and then we can get to showing you the good stuff; your favourite tracks and artists.</p>
            <p class="pt-4">
                <a href="{{ route('login') }}" class="bg-neon-green hover:bg-neon-green-dark text-white font-bold py-2 px-4 rounded mt-2 no-underline">Get started!</a>
            </p>
        </div>
    </div>
</div>

@endsection