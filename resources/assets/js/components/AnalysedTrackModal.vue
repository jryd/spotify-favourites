<template>
    <div>
        <div class="fixed pin z-50 overflow-auto bg-smoke-darker flex" @click="closeModal"> <!-- Oliver to help add close here too -->
        </div>

        <div class="fixed px-8 pb-8 bg-white w-full max-w-md modal-center flex-col flex z-50">
            <div class="flex justify-between items-center border-b border-grey mb-8">
                <h2 class="flex-grow text-4xl font-hairline md:leading-loose text-black">{{ analysedTrack.title }}</h2>

                <svg class="flex-no-grow h-12 w-12 text-grey hover:text-grey-darkest" @click="closeModal" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </div>


            <canvas id="analysedTrackRadar"></canvas>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js';

    export default {

        props: ['analysedTrack'],

        data() {
            return {
                analysedTrackLabels: [
                    'acousticness',
                    'danceability',
                    'energy',
                    'instrumentalness',
                    'liveness',
                    'speechiness',
                    'valence'
                ],
                myRadarChart: '',
                analysedTrackData: {},
            }
        },

        mounted() {
            if (this.rendered) {
                this.destroyAnalysedTrackRadar()
            }
            this.loadGraph()
        },

        methods: {
            loadGraph() {

                this.analysedTrackDataSet = [
                    this.analysedTrack.acousticness,
                    this.analysedTrack.danceability,
                    this.analysedTrack.energy,
                    this.analysedTrack.instrumentalness,
                    this.analysedTrack.liveness,
                    this.analysedTrack.speechiness,
                    this.analysedTrack.valence
                ];

                let data = {
                    labels: this.analysedTrackLabels,
                    datasets: [
                        {
                            backgroundColor: "rgba(98,227,144,0.2)",
                            borderColor: "#1ed760",
                            pointBackgroundColor: "rgba(98,227,144,1)",
                            pointBorderColor: "#1ed760",
                            data: this.analysedTrackDataSet
                        }
                    ],
                    legend: {
                        display: false
                    }
                };

                let chartElement = document.getElementById("analysedTrackRadar")

                this.myRadarChart = new Chart(chartElement.getContext('2d'), {
                    type: 'radar',
                    data: data,
                    options: {
                        legend: {
                        display: false
                        }
                    }
                });
            },

            closeModal() {
                // this.myRadarChart.destroy()
                console.log("emitting close modal");
                this.$emit('analysed-track-modal-close')
            },
        }
    }
</script>
