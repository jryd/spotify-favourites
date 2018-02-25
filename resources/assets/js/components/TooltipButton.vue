<template>
    <div v-on:mouseover="showToolTip=true" v-on:mouseleave="showToolTip=false" class="inline-block relative bg-blue hover:bg-blue-dark text-white font-bold py-4 px-4 rounded-full">
      <slot></slot>
      <Tooltip :transition="transition" :show="showToolTip"></Tooltip>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tracks: [],
                type: 'tracks',
                term: 'medium_term',
                analysedTrack: [],
                analysedTrackLabels: ['acousticness', 'danceability', 'energy', 'instrumentalness', 'liveness', 'speechiness', 'valence'],
                analysedTrackDataSet: [],
                myRadarChart: '',
            }
        },

        methods: {
            fetchStats() {
                /* $('#fetchStats').addClass('is-loading');
                $('#fetchStats').prop("disabled", true); */

                this.tracks = [];
                axios.get('/myfavouritesdata', {
                    params: {
                        type: this.type,
                        time_range: this.term
                    }
                }).then((response) => {
                    this.tracks = response.data;
                    this.$nextTick( function() {
                        $('.bg-image').css('height', $('.bg-image').width());
                        // $('#fetchStats').removeClass('is-loading');
                        // $('#fetchStats').prop("disabled", false);
                    });
                });
            },

            reset() {
                this.tracks = [];
            },

            fetchAnalysedTrack(track) {
                this.analysedTrack = [];
                axios.get('/analysedtrackdata', {params:  {track: track}}).then((response) => {
                    this.analysedTrack = response.body;
                    this.analysedTrackDataSet = [this.analysedTrack.acousticness, this.analysedTrack.danceability, this.analysedTrack.energy, this.analysedTrack.instrumentalness, this.analysedTrack.liveness, this.analysedTrack.speechiness, this.analysedTrack.valence];
                    let data = {
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

                    this.myRadarChart = new Chart($("#analysedTrackRadar"), {
                        type: 'radar',
                        data: data,
                        options: {
                            legend: {
                            display: false
                            }
                        }
                    });

                    $(".modal").addClass('is-active');
                });
            },

            destroyAnalysedTrackRadar() {
                this.myRadarChart.destroy();
                $(".modal").removeClass('is-active');
            },
        }
    }
</script>
