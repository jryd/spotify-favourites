<!DOCTYPE html>
<html>
    <head>
        <title>My Stats | Laravel Spotify</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
        <link rel="stylesheet" href="{{ secure_asset('assets/css/custom.css') }}" />
    </head>
    
    <body>
        <div id="mystats" class="container">
            <h1>My Top Tracks</h1>
            
            <div class="row">
                <div class="panel-group" v-if="tracks.length < 1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Query Options</h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <p v-if="loading"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></p>
                                <form v-on:submit.prevent="fetchStats" v-else>
                                    <fieldset class="form-group">
                                        <legend>Stat options</legend>
                                        <div class="form-check">
                                          <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="statRadio" value="tracks" v-model="type">
                                            I want to see my top tracks
                                          </label>
                                        </div>
                                        <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="statRadio" v-model="type" value="artists">
                                            I want to see my top artists
                                          </label>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <legend>Term options</legend>
                                        <div class="form-check">
                                          <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="termRadio" v-model="term" value="short_term">
                                            Short term
                                          </label>
                                        </div>
                                        <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="termRadio" v-model="term" value="medium_term">
                                            Medium term
                                          </label>
                                        </div>
                                        <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="termRadio" v-model="term" value="long_term">
                                            Long term
                                          </label>
                                        </div>
                                    </fieldset>
                                    <button class="btn btn-primary">Fetch Stats</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <button class="btn btn-primary" v-on:click="reset">Go again!</button>
                </div>
            </div>
            
            <div class="row top-buffer">
                
                <div class="col-md-4" v-if="type == 'tracks'" v-for="(track, index) in tracks">
                    <div class="panel panel-default" >
                      <div class="panel-heading"><a :href="track.external_urls.spotify" target="_blank">@{{ index + 1 }}. @{{ track.name }}</a></div>
                      <div class="panel-body"><i :style="{ 'background-image': `url(${track.album.images[1].url})` }" :alt="track.name" class="bg-image"></i></div>
                    </div>
                </div>
                
                <div class="col-md-4" v-if="type == 'artists'" v-for="(track, index) in tracks">
                    <div class="panel panel-default">
                      <div class="panel-heading"><a :href="track.external_urls.spotify" target="_blank">@{{ index + 1 }}. @{{ track.name }}</a></div>
                      <div class="panel-body"><i :style="{ 'background-image': `url(${track.images[0].url})` }" class="bg-image"></i></div>
                    </div>
                </div>
                
            </div>
        </div>
        
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.3/vue.min.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.3/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <script type="text/javascript">
            $vue = new Vue({
                el: '#mystats',
                
                data: {

                    tracks: [],
                    type: 'tracks',
                    term: 'medium_term',
                    loading: '',
                    showOptions: true,
            
                },
                
                mounted: function() {
                    //
                },
                
                watch: {
                    //
                },
                
                methods: {
                    fetchStats: function()
                    {
                        this.showOptions = false;
                        this.loading = 'loading';
                        this.tracks = [];
                        this.$http.get('/mystatsdata', {params:  {type: this.type, time_range: this.term}}).then((response) => {
                            console.log('fetched');
                            this.loading = '';
                            this.tracks = response.body;
                            console.log(JSON.stringify(this.tracks));
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