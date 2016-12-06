<!DOCTYPE html>
<html>
    <head>
        <title>Welcome | Laravel Spotify</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="{{ secure_asset('assets/css/dist/style.min.css') }}" />
        <link rel="stylesheet" href="{{ secure_asset('assets/css/dist/theme.min.css') }}" />
        <link rel="stylesheet" href="{{ secure_asset('assets/css/dist/waitme.min.css') }}" />
        <link rel="stylesheet" href="{{ secure_asset('assets/css/custom.css') }}" />
    </head>
    
    <body class="theme-red">
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <p class="navbar-brand">My Favourites</p>
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