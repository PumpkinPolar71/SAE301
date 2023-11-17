<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>@yield('title')</title>


        <link rel="stylesheet" type="text/css" href="{{asset('style.css')}}"/>   

    </head>


    <body>
    <script src="recherche.js" defer></script>
    	<header>
    		<!-- <h1>@yield('title')</h1> -->
    	</header>

        @section('nav')
            <ul id="topnav">
                <li><a class="logo" href="{{ url("/") }}">LeBonCoin</a></li>
                <li><a href="{{ url("/annonce/add") }}">Déposer une annonce</a></li>
                <li><a href="{{ url("/annonces") }}">"champs de saisie"</a></li>
                <li><a href="{{ url("/") }}">Mes recherches</a></li>
                <li><a href="{{ url("/") }}">Favoris</a></li>
                <li><a href="{{ url("/") }}">Message</a></li>
                <li><a href="{{ url("/createaccount") }}">Se connecter</a></li>
            </ul>
        @show

        <div class="container">
            @yield('content')
        </div>



    </body>
</html>