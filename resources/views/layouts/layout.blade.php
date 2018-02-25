<!DOCTYPE html>
<html lang="en" style="height: 100%">
<head>
    <meta charset="UTF-8">
    <title>@yield('pageTitle') | Spotify Favourites</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

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
<!-- <body class="bg-gradient-black-to-grey bg-cover bg-no-repeat" style="height: 100%"> -->
<body class="bg-black">
    <div id="app">
        @include('shared.nav')

        <div class="container mx-auto">
                @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    @yield('pageScripts')
</body>
</html>