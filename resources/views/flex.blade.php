<!DOCTYPE html>
<html>
    <head>
        <title>My Stats | Laravel Spotify</title>
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="{{ secure_asset('assets/css/custom.css') }}" />
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
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.3/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.min.js"></script>
        
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
                    this.fetchStats();
                },
                
                watch: {
                    type: function() {
                        this.fetchStats();
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
                    }
                }
            })
        </script>
    </body>
</html>