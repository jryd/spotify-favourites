@extends('layouts.layout')

@section('pageTitle')
Favourites
@endsection

@section('title')
Spotify Favourites
@endsection

@section('subtitle')
A way to visualise your top tracks and artists.
@endsection

@section('content')
<div>
    <favourites-control-panel></favourites-control-panel>
</div>
@endsection