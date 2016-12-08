<!DOCTYPE html>
<html>
    <head>
        <title>Welcome | Spotify Favourites</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/manifest.json">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">
        
        <meta property="og:url" content="{{ url('/') }}" />
        <meta property="og:type" content="article">
        <meta property="og:title" content="Spotify Favourites" />
        <meta property="og:image" content="{{ url('/spotify-icon.png') }}" />
        <meta property="og:description" content="A quick and easy way to view your top tracks and artists from Spotify." />
        <meta property="og:site_name" content="Spotify Favourites" />
        <meta name="author" content="James Bannister">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="{{ secure_asset('assets/css/dist/style.min.css') }}" />
        <link rel="stylesheet" href="{{ secure_asset('assets/css/dist/theme.min.css') }}" />
        <link rel="stylesheet" href="{{ secure_asset('assets/css/dist/waitme.min.css') }}" />
        <link rel="stylesheet" href="{{ secure_asset('assets/css/custom.css') }}" />
        
        @if (App::environment('production'))
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
            
            ga('create', 'UA-88687620-1', 'auto');
            ga('send', 'pageview');
        </script>
        @endif
        
    </head>
    
    <body class="theme-red">
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <p class="navbar-brand">Spotify Favourites</p>
                </div>
            </div>
        </nav>
        <div id="mystats" class="container home-container">
            
            <div class="col-md-6 col-md-offset-3">
                <div class="card">
                    <div class="header">
                        <h2>Welcome!</h2>
                    </div>
                    <div class="body">
                        <p>Ever wondered what your top artists or tracks are on Spotify? Well, wonder no more!</p>
                        <p>To get started, just click the button below - you will be taken to Spotify to authorise the application on your account and then we can get to showing you the good stuff; your favourite tracks and artists.</p>
                        <a href="{{ url('/login/spotify') }}" class="btn btn-primary">Get started!</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>