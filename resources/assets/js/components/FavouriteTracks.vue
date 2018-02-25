<template>
    <div>
        <h1 class="font-bold text-3xl text-white mt-4 ml-8">My Top Tracks &amp; Artists</h1>

        <div class="max-w-md rounded overflow-hidden shadow-lg mx-auto mt-8 border bg-grey-lightest" v-if="this.tracks.length == 0">
            <div class="py-4 px-4">
                <h2 class="font-bold text-xl pb-2 border-b">
                    Query Options
                </h2>
                <div class="mt-2">
                    <form v-on:submit.prevent="fetchStats">
                        <div class="text-l font-bold mb-2">Track or artist?</div>
                        <div class="inline-block relative w-auto mb-6">
                            <select class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-4 py-2 pr-8 rounded shadow"
                                v-model="type"
                            >
                                <option value="tracks">Top Tracks</option>
                                <option value="artists">Top Artists</option>
                            </select>
                            <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>

                        <div class="text-l font-bold mb-2">When calculating this, how much data should we look at?</div>
                        <div class="inline-block relative w-auto mb-6">
                            <select class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-4 py-2 pr-8 rounded shadow"
                                v-model="term"
                            >
                                <option value="short_term">Last 4 weeks</option>
                                <option value="medium_term">Last 6 months</option>
                                <option value="long_term">Since the beginning of time</option>
                            </select>
                            <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>

                        <div class="block">
                            <button class="bg-neon-green hover:bg-neon-green-dark text-white font-bold py-2 px-4 rounded mt-2" id="fetchStats">Fetch Stats</button>
                        </div>
                        <p style="pt-4">
                            <small>
                                <span class="hint--right" data-hint="Measured on the expected preference a user has for a particular track or artist. It is based on user behavior, including play history."  style="display:inline-block;">How is this calculated?</span>
                            </small>
                        </p>
                    </form>
                </div>
            </div>
        </div>

        <div class="fixed pin-r pin-b mb-4 mr-4 z-10;" v-show="tracks.length > 0">
            <button class="bg-neon-green hover:bg-neon-green-dark text-white font-bold py-2 px-4 rounded mt-2" v-on:click="reset">Go again!</button>
        </div>

        <div class="flex flex-wrap justify-between mb-4 mt-8 -mx-2" v-if="this.tracks.length > 0">
            <div class="w-1/3 px-2 pb-2"
                v-if="type == 'tracks'"
                v-for="(track, index) in tracks"
                :key="track.id"
            >
                <div class="bg-grey-lightest h-full">
                    <div class="max-w-sm overflow-hidden v-full">
                        <img class="w-full bg-image" :src="track.album.images[1].url" :alt="track.name">
                        <div class="">
                            <div class="px-6 py-4">
                                <div class="flex">
                                    <div class="font-bold text-xl mb-2 flex-grow">{{ track.name }}</div>
                                    <div class="inline-block rounded-full h-8 w-8 flex items-center justify-center bg-grey text-white flex-no-shrink ml-1">{{ index + 1 }}</div>
                                </div>
                                <p class="text-grey-darker text-base flex-1">
                                    {{ track.artists[0].name }}
                                </p>
                            </div>

                            <div class="px-6 py-4">
                                <a href="#" class="inline-block bg-grey rounded-full px-3 py-1 text-grey-lightest mr-2 no-underline hover:bg-grey" @click.prevent="fetchAnalysedTrack(track, $event)">See Track Elements</a>
                                <a :href="track.external_urls.spotify" target="_blank" class="inline-block bg-grey rounded-full px-3 py-1 text-grey-lightest mr-2 no-underline hover:bg-grey">Play</a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <analysed-track-modal v-if="showModal" :analysedTrack="analysedTrack" v-on:analysed-track-modal-close="toggleModal"></analysed-track-modal>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tracks: [],
                type: 'tracks',
                term: 'medium_term',
                analysedTrack: {},
                showModal: false,
            }
        },

        methods: {
            fetchStats() {
                $('#fetchStats').addClass('loader');
                $('#fetchStats').prop("disabled", true);

                this.tracks = [];
                axios.get('/myfavouritesdata', {
                    params: {
                        type: this.type,
                        time_range: this.term
                    }
                }).then(response => {
                    this.tracks = response.data;
                    this.$nextTick( function() {
                        $('.bg-image').css('height', $('.bg-image').width());
                        $('#fetchStats').removeClass('loader');
                        $('#fetchStats').prop("disabled", false);
                    })
                })
            },

            reset() {
                this.tracks = []
            },

            toggleModal() {
                this.showModal = !this.showModal
            },

            fetchAnalysedTrack(track, event) {
                $(event.target).addClass("loader");
                this.analysedTrackData = []
                axios.get('/analysedtrackdata', {
                        params: {
                            track: track.id
                        }
                }).then( (response) => {
                    this.analysedTrack = response.data
                    this.analysedTrack["title"] = track.name
                    this.toggleModal()
                    $(event.target).removeClass("loader");
                })
            }
        }
    }
</script>
