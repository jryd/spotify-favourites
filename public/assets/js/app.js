$vue = new Vue({
    
    el: '#mystats',
    
    data: {

        tracks: [],
        type: 'tracks',
        term: 'medium_term',
        analysedTrack: [],
        analysedTrackLabels: ['acousticness', 'danceability', 'energy', 'instrumentalness', 'liveness', 'speechiness', 'valence'],
        analysedTrackDataSet: [],

    },
    
    mounted: function() {
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    },
    
    watch: {
        //
    },
    
    methods: {
        fetchStats: function()
        {
            $('#queryOptions').waitMe({
                effect : 'rotation',
                text : '',
                bg : 'rgba(255,255,255,0.7)',
                color : '#f44336',
                maxSize : '',
                textPos : 'vertical',
                fontSize : '',
                source : ''
            });
            this.tracks = [];
            this.$http.get('/myfavouritesdata', {params:  {type: this.type, time_range: this.term}}).then((response) => {
                this.tracks = response.body;
                $('#queryOptions').waitMe('hide');
                this.$nextTick(function()
                {
                    $('.bg-image').css('height', $('.bg-image').width());
                });
            });
        },
        reset: function()
        {
            this.tracks = [];
        },
        fetchAnalysedTrack: function(track)
        {
            $('body').waitMe({
                effect : 'rotation',
                text : '',
                bg : 'rgba(255,255,255,0.7)',
                color : '#f44336',
                maxSize : '',
                textPos : 'vertical',
                fontSize : '',
                source : ''
            });
            this.analysedTrack = [];
            this.$http.get('/analysedtrackdata', {params:  {track: track}}).then((response) => {
                this.analysedTrack = response.body;
                this.analysedTrackDataSet = [this.analysedTrack.acousticness, this.analysedTrack.danceability, this.analysedTrack.energy, this.analysedTrack.instrumentalness, this.analysedTrack.liveness, this.analysedTrack.speechiness, this.analysedTrack.valence];
                var data = {
                    labels: this.analysedTrackLabels,
                    datasets: [
                        {
                            label: "Analysed Track Elements",
                            backgroundColor: "rgba(246,104,94,0.2)",
                            borderColor: "#f44336",
                            pointBackgroundColor: "rgba(246,104,94,1)",
                            pointBorderColor: "#f44336",
                            data: this.analysedTrackDataSet
                        }
                    ],
                    legend: {
                        display: false
                    }
                };
                var myRadarChart = new Chart($("#analysedTrackRadar"), {
                    type: 'radar',
                    data: data,
                    options: {
                        legend: {
                        display: false
                        }
                    }
                });
                $("#mdModal").modal('show');
                $('body').waitMe('hide');
            });
        },
    }
})