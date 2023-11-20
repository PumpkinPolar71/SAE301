<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <title>@yield('title')</title>


        <link rel="stylesheet" type="text/css" href="{{asset('style.css')}}"/>   

    </head>


    <body>
        <script src="/search.js" defer></script>
    	<header>
    		<!-- <h1>@yield('title')</h1> -->
    	</header>

        @section('nav')
            <ul id="topnav">
                <li><a class="logo" href="{{ url("/annonces") }}">LeBonCoin</a></li>
                <li><a href="{{ url("/annonce/add") }}">Déposer une annonce</a></li>
                <li>
                    <div>
                        <form action="/search" method="post" target="_self">
                            @csrf
                            <input id="search" type="text" name="search" placeholder="Ex: Apagnyan" OnKeyPress="if (event.keyCode == 13)submitForm()"/>
                        </form>
                    </div>
                </li>                  
                <li><a href="{{ url("/") }}">Mes recherches</a></li>
                <li><a href="{{ url("/") }}">Favoris</a></li>
                <li><a href="{{ url("/") }}">Message</a></li>
                <li><a href="{{ url("/connect") }}">Se connecter</a></li>
            </ul><br>
        @show

        
        <div class="container">
            @yield('content')
        </div>



    </body>
</html>