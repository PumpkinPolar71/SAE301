<link rel="stylesheet" type="text/css" href="{{asset('style.css')}}"/> 
<div class="flecheretour" onclick="history.back()">←</div>
<div class="titleconnect"><a href="{{ url("/annonce-filtres?ville=&type_hebergement=") }}"><b>LeBonCoin</b></a></div>
<style>
    body {
        width: 100%;
        margin-left: 0%;
    }
</style>
<section>
    <div class="bonj"><b>Bonjour !</b></div>
    <div class="conn">Connectez-vous pour découvrir toutes nos fonctionnalités.</div>
    <div>email</div>
    <input>
    <div>mot de passe</div>
    <input>
    <div><a href="{{ url('/createaccount') }}">créer un compte</a></div>
</section>
