<!DOCTYPE html>
<html>
    <head>
        <title>My Stats | Spotify Favourites</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/manifest.json">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">
        
        <meta property="og:url" content="{{ url('/') }}" />
        <meta property="og:type" content="article">
        <meta property="og:title" content="Spotify Favourites" />
        <meta property="og:image" content="{{ url('/spotify-icon.png') }}" />
        <meta property="og:description" content="A quick and easy way to view your top tracks and artists from Spotify." />
        <meta property="og:site_name" content="Spotify Favourites" />
        <meta name="author" content="James Bannister">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
        <link rel="stylesheet" href="{{ asset('assets/css/dist/materialize.css') }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="{{ asset('assets/css/dist/style.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/dist/theme.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/dist/waitme.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
        
        @if (App::environment('production'))
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
            
            ga('create', 'UA-88687620-1', 'auto');
            ga('send', 'pageview');
        </script>
        @endif
    </head>
    
    <body class="theme-red">
        <div id="mystats" class="container">
            <h1>My Top Artists &amp; Tracks</h1>
            
            <div class="row">
                <div class="card" v-show="tracks.length < 1" id="queryOptions">
                    <div class="header bg-red">
                        <h2>
                            Query Options <small>What do you want to check out?</small>
                        </h2>
                    </div>
                    <div class="body">
                        <form v-on:submit.prevent="fetchStats">
                            <h2 class="card-inside-title">Track or artist?</h2>
                            <p>
                                <input name="statRadio" type="radio" class="with-gap radio-col-red" id="tracks" value="tracks" v-model="type">
                                <label for="tracks">Top tracks</label>
                            </p>
                            <p>
                                <input name="statRadio" type="radio" class="with-gap radio-col-red" id="artists" value="artists" v-model="type">
                                <label for="artists">Top artists</label>
                            </p>
                                <h2 class="card-inside-title">When calculating this, how much data should we look at?</h2>
                                <p>
                                    <input name="termRadio" type="radio" class="with-gap radio-col-red" value="short_term" id="short_term" v-model="term">
                                    <label for="short_term">Last 4 weeks</label>
                                </p>
                                <p>
                                    <input name="termRadio" type="radio" class="with-gap radio-col-red" value="medium_term" id="medium_term" v-model="term">
                                    <label for="medium_term">Last 6 months</label>
                                </p>
                                <p>
                                    <input name="termRadio" type="radio" class="with-gap radio-col-red" value="long_term" id="long_term" v-model="term">
                                    <label for="long_term">Since the beginning of time</label>
                                </p>
                            <button class="btn btn-primary">Fetch Stats</button>
                            <p style="padding-top: 10px;"><small data-toggle="tooltip" data-placement="right" title="Measured on the expected preference a user has for a particular track or artist. It is based on user behavior, including play history." style="display:inline-block;">How is this calculated?</small></p>
                        </form>
                    </div>
                </div>
                <div class="resetbutton" v-show="tracks.length > 0">
                    <button class="btn btn-primary" v-on:click="reset">Go again!</button>
                </div>
            </div>
            
            <div class="row top-buffer">
                
                <div class="col-md-4" v-if="type == 'tracks'" v-for="(track, index) in tracks">
                    <div class="card">
                        <div class="header bg-red">
                            <h2 class="nameHeading">
                                @{{ track.name }} <small>@{{ track.artists[0].name }}</small>
                            </h2>
                            <p class="header-dropdown m-r--5">@{{ index + 1 }}</p>
                        </div>
                        <div class="body">
                            <i :style="{ 'background-image': `url(${track.album.images[1].url})` }" :alt="track.name" class="bg-image"></i>
                            <button class="btn btn-primary" v-on:click="fetchAnalysedTrack(track.id)" style="margin-top:10px;">See Track Elements</button>
                            <a :href="track.external_urls.spotify" class="btn btn-primary" style="margin-top: 10px;" target="_blank"><i class="fa fa-play"></i> Play</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4" v-if="type == 'artists'" v-for="(track, index) in tracks">
                    <div class="card">
                        <div class="header bg-red">
                            <h2 class="nameHeading">
                                @{{ track.name }} 
                            </h2>
                            <p class="header-dropdown m-r--5">@{{ index + 1 }}</p>
                        </div>
                        <div class="body">
                            <i :style="{ 'background-image': `url(${track.images[0].url})` }" :alt="track.name" class="bg-image"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="mdModal" tabindex="-1" role="dialog" style="display: none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Audio Elements from Track</h4>
                        </div>
                        <div class="modal-body">
                            <canvas id="analysedTrackRadar"></canvas>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" v-on:click="destroyAnalysedTrackRadar">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.3/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="{{ asset('assets/js/dist/waitme.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>
    </body>
</html>