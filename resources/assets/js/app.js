
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('favourites-control-panel', require('./components/FavouritesControlPanel.vue'));
Vue.component('favourite-tracks', require('./components/FavouriteTracks.vue'));
Vue.component('favourite-artists', require('./components/FavouriteArtists.vue'));
Vue.component('reset-button', require('./components/ResetButton.vue'));
Vue.component('analysed-track-modal', require('./components/AnalysedTrackModal.vue'));

const app = new Vue({
    el: '#app',

    data() {
        return {
            active: ''
        }
    },

    mounted() {
        this.active = document.location.pathname
    }
});
