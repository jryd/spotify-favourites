<template>
    <div>
        <div class="flex flex-wrap justify-between mb-4 mt-8 -mx-2">
            <div class="w-1/3 px-2 pb-2"
                v-for="(artist, index) in artists"
                :key="artist.id"
            >
                <div class="bg-grey-lightest h-full">
                    <div class="max-w-sm overflow-hidden h-full relative">
                        <img class="w-full bg-image" :src="artist.images[1].url" :alt="artist.name">
                        <div class="">
                            <div class="px-6 pt-4 pb-8 mb-8">
                                <div class="flex">
                                    <div class="font-bold text-xl mb-2 flex-grow">{{ artist.name }}</div>
                                    <div class="inline-block rounded-full h-8 w-8 flex items-center justify-center bg-grey text-white flex-no-shrink ml-1">{{ index + 1 }}</div>
                                </div>
                            </div>

                            <div class="px-2 pb-4">
                                <div class="absolute pin-b" style="padding: inherit;">
                                    <a :href="artist.external_urls.spotify" target="_blank" class="inline-block bg-grey rounded-full px-3 py-1 text-grey-lightest mr-2 no-underline hover:bg-grey">Play</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['artists'],

        data() {
            return {

            }
        },

        methods: {

        }
    }
</script>
