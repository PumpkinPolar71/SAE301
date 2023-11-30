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

        <div class="bottom-text">Avec leboncoin, trouvez la bonne affaire sur le site référent de petites annonces de particulier à particulier et de professionnels. Avec des millions de petites annonces, trouvez la bonne occasion dans nos catégories immobilier, etc… Déposez une annonce gratuite en toute simplicité pour vendre, rechercher, donner vos biens de seconde main ou promouvoir vos services. Pour cet été, découvrez nos idées de destination avec notre guide de vacances en France. Achetez en toute sécurité avec notre système de paiement en ligne et de livraison pour les annonces éligibles.</div>
        <div class="bottom">

        </div>
    </body>
    <script>
                     /*$(document).ready(function() {
                       alert("Attention: Yanisse pose des bombs dans tout le site !\nETAT ERROR = '💣'");
                     })*/
        </script>
</html>