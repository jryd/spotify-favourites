<template>
    <div class="fixed pin-r pin-b mb-4 mr-4 z-10;">
        <button class="bg-neon-green hover:bg-neon-green-dark text-white font-bold py-2 px-4 rounded mt-2" v-on:click="reset">Go again!</button>
    </div>
</template>

<script>
    export default {

        methods: {
            reset() {
                this.$emit('reset')
            }
        }
    }
</script>
