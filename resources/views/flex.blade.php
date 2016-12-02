<!DOCTYPE html>
<html>
    <head>
        <title>My Stats | Laravel Spotify</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/flat/green.css" />
        <link rel="stylesheet" href="{{ secure_asset('assets/css/flex.css') }}" />
        
    </head>
    
    <body>
        <div class="container" id="mystats">
            <div class="title">
                <span>Your Spotify Faves</span>
            </div>
            <div class="card shadow" v-for="track in tracks">
                <div class="card-top">
                    <img :src="track.album.images[1].url" alt="placeholder" class="vote-image" />
                </div>
                <div class="card-bottom">
                    <span>@{{ track.name }}</span>
                </div>
            </div>
            <div class="card shadow" v-show="tracks.length < 1">
                <div class="card-top">
                    <!--<img :src="track.album.images[1].url" alt="placeholder" class="vote-image" />-->
                    <form v-on:submit.prevent="fetchStats">
                        <fieldset class="form-group">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="statRadio" value="tracks" v-model="type">
                                Tracks
                              </label>
                            </div>
                            <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="statRadio" v-model="type" value="artists">
                                Artists
                              </label>
                            </div>
                        </fieldset>
                        <fieldset class="form-group">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="termRadio" v-model="term" value="short_term">
                                Real-time
                              </label>
                            </div>
                            <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="termRadio" v-model="term" value="medium_term">
                                Recently
                              </label>
                            </div>
                            <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="termRadio" v-model="term" value="long_term">
                                All time
                              </label>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="card-bottom">
                    <button class="btn btn-primary" v-on:click="fetchStats">Fetch!</button>
                </div>
            </div>
            <div class="title" v-show="tracks.length > 0">
                <button class="btn btn-primary" v-on:click="reset">Reset!</button>
            </div>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.3/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
        
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
                    //
                },
                
                watch: {
                    type: function() {
                        console.log(this.type);
                    },
                    term: function () {
                        console.log(this.term);
                    }
                },
                
                methods: {
                    fetchStats: function()
                    {
                        this.loading = 'loading';
                        this.tracks = [];
                        this.$http.get('/mystatsdata', {params:  {type: this.type, time_range: this.term}}).then((response) => {
                            console.log('fetched');
                            this.loading = '';
                            this.tracks = response.body;
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