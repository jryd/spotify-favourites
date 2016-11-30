<!DOCTYPE html>
<html>
    <head>
        <title>My Stats | Laravel Spotify</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    </head>
    
    <body>
        <div id="mystats" class="container">
        <h1>My Top Tracks</h1>
        
        <form v-on:submit.prevent="fetchStats">
            <fieldset class="form-group">
                <legend>Stat options</legend>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" value="tracks" v-model="type">
                    I want to see my top tracks
                  </label>
                </div>
                <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" v-model="type" value="artists">
                    I want to see my top artists
                  </label>
                </div>
            </fieldset>
            <button class="btn btn-primary">Fetch Stats</button>
        </form>
        
        <ol v-if="type == 'tracks'">
            <li v-for="track in tracks[0]">@{{ track.name }} - @{{ track.artists[0].name }}</li>
        </ol>
        <ol v-if="type == 'artists'">
            <li v-for="track in tracks[0]">Artist: @{{ track.name }}</li>
        </ol>
        <pre>@{{ tracks }}</pre>
        </div>
        
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.3/vue.min.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.3/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.min.js"></script>
        
        <script type="text/javascript">
            $vue = new Vue({
                el: '#mystats',
                
                data: {

                    tracks: [],
                    type: 'tracks',
            
                },
                
                mounted: function() {
                    //
                },
                
                methods: {
                    fetchStats: function()
                    {
                        this.$http.get('/mystatsdata', {params:  {type: this.type}}).then((response) => {
                            console.log('fetched');
                            this.tracks = [];
                            this.tracks.push(response.body);
                          }, (response) => {
                            // error callback
                          }); 
                    }
                }
            })
        </script>
    </body>
</html>