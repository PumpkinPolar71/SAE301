<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>


        <link rel="stylesheet" type="text/css" href="{{asset('style.css')}}"/>   

    </head>


    <body>

    	<header>
    		<h1>@yield('title')</h1>
    	</header>

        @section('nav')
            <ul>
                <li><a href="{{ url("/") }}">LenBonCoin</a></li>
                <li><a href="{{ url("/annonces") }}">"champs de saisie"</a></li>
                <li><a href="{{ url("/annonce/add") }}">Ajout</a></li>
                <li><a href="{{ url("/annonce/add") }}">Ajout</a></li>
                <li><a href="{{ url("/annonce/add") }}">Ajout</a></li>
            </ul>
        @show

        <div class="container">
            @yield('content')
        </div>



    </body>
</html>