<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



        <title>@yield('title')</title>


        <link rel="stylesheet" type="text/css" href="{{asset('style.css')}}"/> 

    </head>

    <script>
    $(document).ready(function() {
        rnd = Math.floor(Math.random() * 15)
        console.log(rnd)
        console.log($('.encart-publicitaire'))
        $('.encart-publicitaire').css("background-image" , "url(pub/capture"+rnd+".png)")
    })
        </script>
    <body>
        <script src="/search.js" defer></script>
        <a href="http://licorn--projekt.000webhostapp.com/"><div class="encart-publicitaire"></div></a>
        <div class="allflex">
            <div class="all">
    	    <header>
    		    <!-- <h1>@yield('title')</h1> -->
    	    </header>
            @section('nav')
            <ul id="topnav">
                <li><a class="logo" href="{{ url("/annonce-filtres?ville=&type_hebergement=&datedebut=") }}"><b>LeBonCoin</b></a></li>
                <li style="padding-top:3%;"><a class="depo" href="{{ url("/annonceeuh") }}"><b>Déposer une annonce</b></a></li>
                <li>
                    <div>
                        <form action="/search" method="post" target="_self">
                            @csrf
                            <input style="" id="search" type="text" name="search" placeholder="Ex: Appartement" OnKeyPress="if (event.keyCode == 13)submitForm()" />
                        </form>
                    </div>
                </li>   
                @auth       
                    <li style="float:right"><a class="coone" href="{{ url("/compte") }}">Compte</a></li>    
                    <li style="float:right"><a class="mess" href="{{ url("/") }}">Message</a></li>  
                    <li style="float:right"><a class="fav" href="{{ url('/favoris/'.Auth::user()->compte->idcompte) }}">Favoris</a></li>  
                    <li style="float:right"><a href="{{ url("/") }}">Mes recherches</a></li>

                    @if (Auth::user()->compte->codeetatcompte == 9 )
                    <li style="float:right"><a class="coone" href="{{ url("/serviceimmobilier") }}">service immobilier</a></li>
                    @elseif (Auth::user()->compte->codeetatcompte == 10 )
                    <li style="float:right"><a class="coone" href="{{ url("/incident") }}">service incident</a></li>
                    @elseif (Auth::user()->compte->codeetatcompte == 11 )
                    <li style="float:right"><a class="coone" href="{{ url("/enregistrer_avis") }}">service avis</a></li>
                    @endif
                
                @else
                    <li style="float:right"><a class="coone" href="{{ url("/connect") }}">Se connecter</a></li>
                    <li style="float:right"><a class="mess" href="{{ url("/") }}">Message</a></li>
                    <li style="float:right"><a class="fav" href="{{ url("/redirection") }}">Favoris</a></li>
                    <li style="float:right"><a href="{{ url("/") }}">Mes recherches</a></li>
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
                <div>A PROPOS DU BONCOIN
                    <div class=""></div>
                </div>
                <div>INFORMATION LEGALES
                    <div class=""></div>
                </div>
                <div>NOS SOLUTIONS PROS
                    <div class=""></div>
                </div>
                <div>DES QUESTIONS ?
                    <div class=""></div>
                </div>
            </div>
        </div>
    </body>
</html>