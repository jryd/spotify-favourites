@extends('layouts.layout')

@section('pageTitle')
Denied
@endsection

@section('title')
Spotify Favourites
@endsection

@section('subtitle')
A way to visualise your top tracks and artists.
@endsection

@section('content')
<div class="columns">
    <div class="column is-half is-offset-one-quarter">
        <div class="box">
            <h1 class="title">Uh Oh!</h1>
            <p>Looks like you didn't give me permission to access your Spotify account!</p>
            <p>For the app to work it requires access to your account to retrieve your top tracks or artists.</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Try again!</a>
        </div>
    </div>
</div>

@endsection