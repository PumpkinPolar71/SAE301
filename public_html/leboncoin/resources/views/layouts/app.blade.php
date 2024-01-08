<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



        <title>@yield('title')</title>


        <link rel="stylesheet" type="text/css" href="{{asset('style.css')}}"/> 

    </head>


    <script src="/tarteaucitron/tarteaucitron.js"></script>

<script type="text/javascript">
tarteaucitron.init({
  "privacyUrl": "", /* Privacy policy url */
  "bodyPosition": "bottom", /* or top to bring it as first element for accessibility */

  "hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
  "cookieName": "tarteaucitron", /* Cookie name */

  "orientation": "middle", /* Banner position (top - bottom) */

  "groupServices": false, /* Group services by category */
  "showDetailsOnClick": true, /* Click to expand the description */
  "serviceDefaultState": "wait", /* Default state (true - wait - false) */
                   
  "showAlertSmall": false, /* Show the small banner on bottom right */
  "cookieslist": false, /* Show the cookie list */
                   
  "closePopup": false, /* Show a close X on the banner */

  "showIcon": true, /* Show cookie icon to manage cookies */
  //"iconSrc": "", /* Optionnal: URL or base64 encoded image */
  "iconPosition": "BottomLeft", /* BottomLeft, BottomLeft, TopRight and TopLeft */

  "adblocker": false, /* Show a Warning if an adblocker is detected */
                   
  "DenyAllCta" : true, /* Show the deny all button */
  "AcceptAllCta" : true, /* Show the accept all button when highPrivacy on */
  "highPrivacy": true, /* HIGHLY RECOMMANDED Disable auto consent */
                   
  "handleBrowserDNTRequest": false, /* If Do Not Track == 1, disallow all */

  "removeCredit": false, /* Remove credit link */
  "moreInfoLink": true, /* Show more info link */

  "useExternalCss": false, /* If false, the tarteaucitron.css file will be loaded */
  "useExternalJs": false, /* If false, the tarteaucitron.js file will be loaded */

  //"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for multisite */
                  
  "readmoreLink": "", /* Change the default readmore link */

  "mandatory": true, /* Show a message about mandatory cookies */
  "mandatoryCta": true, /* Show the disabled accept button when mandatory on */

  //"customCloserId": "" /* Optional a11y: Custom element ID used to open the panel */
});
</script>

<script type="text/javascript">
tarteaucitron.user.googletagmanagerId = 'GTM-XXXX';
(tarteaucitron.job = tarteaucitron.job || []).push('googletagmanager');
        tarteaucitron.user.googleadsId = 'AW-XXXXXXXXX';
        (tarteaucitron.job = tarteaucitron.job || []).push('googleads');
</script>



    <script>
    $(document).ready(function() {
        rnd = Math.floor(Math.random() * 15)
        $('.encart-publicitaire').css("background-image" , "url(../pub/capture"+rnd+".png)")
        $('.encart-publicitaire').css("z-index" , "1")
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
                <li><a class="logo" href="{{ url("/annonce-filtres?ville=&type_hebergement=&datedebut=") }}"><b>leboncoin</b></a></li>
                <li style="padding-top:3%;"><a class="depo" href="{{ url("/createAnnonce") }}"><b>Déposer une annonce</b></a></li>
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
                    <li style="float:right"><a class="mess" href="{{ url("/mes_messages") }}">Message</a></li>
                    <li style="float:right"><a class="fav" href="{{ url('/favoris/'.Auth::user()->compte->idcompte) }}">Favoris</a></li>  
                    <li style="float:right"><a href="{{ url("/mes_recherches") }}">Mes recherches</a></li>

                    @if (Auth::user()->compte->codeetatcompte == 13 )<!--9-->
                    <li style="float:right"><a class="coone" href="{{ url("/annonces-non-validees") }}">service petite annonce</a></li><!--test num tel-->
                    <li style="float:right"><a class="coone" href="{{ url("/serviceimmobilier") }}">service immobilier</a></li><!--valide annonce-->
                    @elseif (Auth::user()->compte->codeetatcompte == 10 )
                    <li style="float:right"><a class="coone" href="{{ url("/incident") }}">service incident</a></li><!--gerer incident-->
                    @elseif (Auth::user()->compte->codeetatcompte == 11 )
                    <li style="float:right"><a class="coone" href="{{ url("/") }}">modif avis</a></li><!--modif avie-->
                    @elseif (Auth::user()->compte->codeetatcompte == 12 )
                    <li style="float:right"><a class="coone" href="{{ url("/") }}">valider nouveau compte</a></li><!--valide nouveau compte -->
                    @elseif (Auth::user()->compte->codeetatcompte == 13 )
           
                    @elseif (Auth::user()->compte->codeetatcompte == 14 )
                    <li style="float:right"><a class="coone" href="{{ url("/service_annonce") }}">service annonce</a></li> <!--creer type hebergement / creer equipement-->
                    @elseif (Auth::user()->compte->codeetatcompte == 15 )
                    <li style="float:right"><a class="coone" href="{{ url("/inscription-attente") }}">service inscription</a></li> <!--service inscription verifier  demande d'inscriuption(verif annonce et date)-->
                    @endif
                @else
                    <li style="float:right"><a class="coone" href="{{ url("/connect") }}">Se connecter</a></li>
                    <li style="float:right"><a class="mess" href="{{ url("/redirection") }}">Message</a></li>
                    <li style="float:right"><a class="fav" href="{{ url("/redirection") }}">Favoris</a></li>
                    <li style="float:right"><a href="{{ url("/redirection") }}">Mes recherches</a></li>
                @endauth

            </ul><br>
            @show
            @section('nav2')
        
            @show
             
            <div class="container">
            @yield('content')
            </div>
            <div class="bottom-text" >Avec leboncoin, trouvez la bonne affaire sur le site référent de petites annonces de particulier à particulier et de professionnels. Avec des millions de petites annonces, trouvez la bonne occasion dans notre catégorie immobilier. Déposez une annonce gratuite en toute simplicité pour vendre, rechercher, donner vos biens de seconde main ou promouvoir vos services. Pour cet été, découvrez nos idées de destination avec notre guide de vacances en France. Achetez en toute sécurité avec notre système de paiement en ligne et de livraison pour les annonces éligibles.</div>
    
            <div id="bottom" style="">
                <div>
                <div class="firstbottom">A PROPOS DU BONCOIN</div>
                    <div class=""></div>
                </div>
                <div>
                <div class="firstbottom">INFORMATIONS LEGALES</div>
                    <div class="cookie"><a href="cookie">Les cookies</a></div>
                    <div class=""><a href="politique">Politique de protection des données</a></div>
                    <div class=""><a href="registre">Registre des traitements</a></div>
                    <div class=""><a href="contrat">Le contrat OVH</a></div>
                </div>
                <div>
                <div class="firstbottom">NOS SOLUTIONS PROS</div>
                    <div class=""></div>
                </div>
                <div>
                    <div class="firstbottom">DES QUESTIONS ?</div>
                    <p id="p"><a href="{{ url("/aide") }}">Aide</a></p>
                </div>
                </div>
        </div>
   
    </body>
</html>