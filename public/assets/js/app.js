$vue = new Vue({
    el: '#mystats',
    
    data: {

        tracks: [],
        type: 'tracks',
        term: 'medium_term',
        loading: '',

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
            this.loading = 'loading';
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
        }
    }
})