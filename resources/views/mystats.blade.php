<!DOCTYPE html>
<html>
    <head>
        <title>My Stats | Laravel Spotify</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="{{ secure_asset('assets/css/dist/style.min.css') }}" />
        <link rel="stylesheet" href="{{ secure_asset('assets/css/dist/theme.min.css') }}" />
        <link rel="stylesheet" href="{{ secure_asset('assets/css/dist/waitme.min.css') }}" />
        <link rel="stylesheet" href="{{ secure_asset('assets/css/custom.css') }}" />
    </head>
    
    <body class="theme-red">
        <div id="mystats" class="container">
            <h1>My Top Artists &amp; Tracks</h1>
            
            <div class="row">
                <div class="card" v-if="tracks.length < 1" id="queryOptions">
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
                <div class="resetbutton" v-else>
                    <button class="btn btn-primary" v-on:click="reset">Go again!</button>
                </div>
            </div>
            
            <div class="row top-buffer">
                
                <div class="col-md-4 col-sm-6 col-xs-10" v-if="type == 'tracks'" v-for="(track, index) in tracks">
                    <div class="card">
                        <div class="header bg-red">
                            <h2 class="nameHeading">
                                @{{ track.name }} <small>@{{ track.artists[0].name }}</small>
                            </h2>
                            <p class="header-dropdown m-r--5">@{{ index + 1 }}</p>
                        </div>
                        <div class="body">
                            <i :style="{ 'background-image': `url(${track.album.images[1].url})` }" :alt="track.name" class="bg-image"></i>
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
        </div>
        
        <div class="modal fade" id="howCalculatedModal" tabindex="-1" role="dialog" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales orci ante, sed ornare eros vestibulum ut. Ut accumsan
                        vitae eros sit amet tristique. Nullam scelerisque nunc enim, non dignissim nibh faucibus ullamcorper.
                        Fusce pulvinar libero vel ligula iaculis ullamcorper. Integer dapibus, mi ac tempor varius, purus
                        nibh mattis erat, vitae porta nunc nisi non tellus. Vivamus mollis ante non massa egestas fringilla.
                        Vestibulum egestas consectetur nunc at ultricies. Morbi quis consectetur nunc.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.3/vue.min.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.3/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="{{ secure_asset('assets/js/dist/waitme.min.js') }}"></script>
        
        <script type="text/javascript">
            $vue = new Vue({
                el: '#mystats',
                
                data: {

                    tracks: [],
                    type: 'tracks',
                    term: 'medium_term',
                    loading: '',
            
                },
                
                mounted: function() {
                    jQuery(function () {
                        jQuery('[data-toggle="tooltip"]').tooltip()
                    });
                },
                
                watch: {
                    //
                },
                
                methods: {
                    fetchStats: function()
                    {
                        jQuery('#queryOptions').waitMe({
                            effect : 'rotation',
                            text : '',
                            bg : 'rgba(255,255,255,0.7)',
                            color : '#f44336',
                            maxSize : '',
                            textPos : 'vertical',
                            fontSize : '',
                            source : ''
                        });
                        this.loading = 'loading';
                        this.tracks = [];
                        this.$http.get('/mystatsdata', {params:  {type: this.type, time_range: this.term}}).then((response) => {
                            console.log('fetched');
                            this.tracks = response.body;
                            jQuery('#queryOptions').waitMe('hide');
                            }, (response) => {
                            // error callback
                        });
                    },
                    reset: function()
                    {
                        this.tracks = [];
                    }
                }
            })
        </script>
    </body>
</html>