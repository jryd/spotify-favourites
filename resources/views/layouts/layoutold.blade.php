<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('pageTitle') | Spotify Favourites</title>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.3/css/bulma.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.4/vue.js"></script> --}}


    <link rel="stylesheet" href="{{ asset('assets/css/bulma.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hint.css/2.5.0/hint.min.css" />

    {{-- Google Analytics Code - we only want this to show in production --}}
    @if (App::environment('production'))
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', '{{ env('GOOGLE_ANALYTICS_TRACKING_ID') }}', 'auto');
            ga('send', 'pageview');
        </script>
    @endif

</head>

<body>
    <div id="nav">
        <nav class="navbar">
            <div class="navbar-brand">
                <a href="{{ url('/') }}" class="navbar-item">
                    Spotify Favourites
                </a>

                <div class="navbar-burger" @click="showNav = !showNav" :class="{ 'is-active': showNav }">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="navbar-menu" :class="{ 'is-active': showNav }">
                <div class="navbar-start">
                    <a href="{{ route('favourites') }}" class="navbar-item">Favourites</a>
                    <a href="{{ route('dashboard') }}" class="navbar-item">Dashboard</a>
                </div>
            </div>
        </nav>
    </div>

    <section class="hero is-success is-bold">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
               @yield('title')
            </h1>
            <h2 class="subtitle">
                @yield('subtitle')
            </h2>
        </div>
    </div>
</section>

    <section class="section">
        <div class="container">

            @yield('content')
        </div>
    </section>

    <script src="{{ asset('assets/js/vue.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    {{-- Vue script to control the navigation bar --}}
    <script type="text/javascript">
        new Vue({
            el: '#nav',
            data: {
                showNav: false
            }
        });
    </script>

    {{-- JS to automatically dismiss notifications that are not important --}}
    <script type="text/javascript">
        $('div.notification').not('.notification-important').delay(3000).fadeOut(350);
    </script>

    @yield('pageScripts')
</body>
</html>