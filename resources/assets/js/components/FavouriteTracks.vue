<template>
    <div>
        <div class="flex flex-wrap justify-between mb-4 mt-8 -mx-2">
            <div class="w-1/3 px-2 pb-2"
                v-for="(track, index) in tracks"
                :key="track.id"
            >
                <div class="bg-grey-lightest h-full">
                    <div class="max-w-sm overflow-hidden h-full relative">
                        <img class="w-full bg-image" :src="track.album.images[1].url" :alt="track.name">
                        <div class="">
                            <div class="px-6 pt-4 pb-8 mb-8">
                                <div class="flex">
                                    <div class="font-bold text-xl mb-2 flex-grow">{{ track.name }}</div>
                                    <div class="inline-block rounded-full h-8 w-8 flex items-center justify-center bg-grey text-white flex-no-shrink ml-1">{{ index + 1 }}</div>
                                </div>
                                <p class="text-grey-darker text-base flex-1">
                                    {{ track.artists[0].name }}
                                </p>
                            </div>

                            <div class="px-2 pb-4">
                                <div class="absolute pin-b" style="padding: inherit;">
                                    <a href="#" class="inline-block bg-grey rounded-full px-3 py-1 text-grey-lightest mr-2 no-underline hover:bg-grey" @click.prevent="fetchAnalysedTrack(track, $event)">See Track Elements</a>
                                    <a :href="track.external_urls.spotify" target="_blank" class="inline-block bg-grey rounded-full px-3 py-1 text-grey-lightest mr-2 no-underline hover:bg-grey">Play</a>
                                </div>
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
        props: ['tracks'],

        data() {
            return {
                analysedTrack: {},
                showModal: false,
            }
        },

        methods: {

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
