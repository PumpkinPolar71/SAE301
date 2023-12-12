<link rel="stylesheet" type="text/css" href="{{asset('create.css')}}"/> 
<div class="flecheretour" onclick="history.back()">←</div>
<div class="titleconnect"><a href="{{ url("/annonce-filtres?ville=&type_hebergement=&datedebut=") }}"><b>LeBonCoin</b></a></div>
<style>
    body {
        width: 100%;
        margin-left: 0%;
    }
</style>
<section class="connectsec">
    <div class="bonj"><b>Bonjour !</b></div>
    <div class="conn">Vous avez besoin de vous connecter pour utiliser cette fonctionnalitée.
    <div class="redirco">Vous avez déjà un compte ? <a href="{{ url("/connect") }}">Connecter vous !</a></div>
    <div class="">Vous n'avez pas encore de compte ? Alors, <a href="{{ url("/createaccount") }}">rejoigner nous !</a></div>

</section>
