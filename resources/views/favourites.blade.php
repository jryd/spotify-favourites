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

        <favourite-tracks-and-artists></favourite-tracks-and-artists>

        <!-- <div class="fixed pin z-50 overflow-auto bg-smoke-darker flex">
            <div class="relative p-8 bg-white w-full max-w-md m-auto flex-col flex">
                <span class="absolute pin-t pin-b pin-r p-4">
                    <svg class="h-12 w-12 text-grey hover:text-grey-darkest" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        </div> -->

            <!-- <div class="column is-one-quarter" v-if="type == 'artists'" v-for="(track, index) in tracks">
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-square">
                            <img :src="track.images[1].url" :alt="track.name">
                        </figure>
                    </div>
                    <div class="card-content">
                        <p class="title is-4">@{{ track.name }}</p>
                        <p>Track @{{ index + 1 }}</p>
                    </div>
                    <footer class="card-footer">
                        <a :href="track.external_urls.spotify" target="_blank" class="card-footer-item">Play</a>
                    </footer>
                </div>
            </div> -->
    </div>

        <!-- <div class="modal">
            <div class="modal-background" v-on:click="destroyAnalysedTrackRadar"></div>
            <div class="modal-card">
                <section class="modal-card-body">
                    <h4 class="is-title is-4">Audio Elements from Track</h4>
                    <canvas id="analysedTrackRadar"></canvas>
                </section>
            </div>
            <button class="modal-close is-large" aria-label="close" v-on:click="destroyAnalysedTrackRadar"></button>
        </div>
    </div> -->

@endsection