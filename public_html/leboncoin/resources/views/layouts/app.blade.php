<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <title>@yield('title')</title>


        <link rel="stylesheet" type="text/css" href="{{asset('style.css')}}"/> 

    </head>


    <body>
        <script src="/search.js" defer></script>
    	<header>
    		<!-- <h1>@yield('title')</h1> -->
    	</header>

        @section('nav')
        <div class=""></div>
            <ul id="topnav">
                <li><a class="logo" href="{{ url("/annonce-filtres?ville=&type_hebergement=&datedebut=") }}">LeBonCoin</a></li>
                <li><a class="depo" href="{{ url("/annonce/add") }}">Déposer une annonce</a></li>
                <li>
                    <div>
                        <form action="/search" method="post" target="_self">
                            @csrf
                            <input id="search" type="text" name="search" placeholder="Ex: Appartement" OnKeyPress="if (event.keyCode == 13)submitForm()" />
                        </form>
                    </div>
                </li>                  
                <li><a href="{{ url("/") }}">Mes recherches</a></li>
                <li><a class="fav" href="{{ url("/") }}">Favoris</a></li>
                <li><a class="mess" href="{{ url("/") }}">Message</a></li>
                @auth
                <li><a class="coone" href="{{ url("/compte") }}">Compte</a></li>
                @else
                <li><a class="coone" href="{{ url("/connect") }}">Se connecter</a></li>
                @endauth
            </ul><br>
        @show

        @section('nav2')
            
        @show
        
        <div class="container">
            @yield('content')
        </div>



    </body>
    <script>
                     $(document).ready(function() {
                       alert("Attention: Yanisse pose des bombs dans tout le site !\nETAT ERROR = '💣'");
                     })
        </script>
</html>