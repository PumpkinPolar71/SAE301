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
    <form method="post" action="{{ route("/login") }}">
    @csrf
    <label>Email :</label><br>
    <input type="text" name="login"/><br>
    <label>Mot de passe :</label><br>
    <input type="password" name="passwd"/><br><br>
    <input type="submit" value="connexion"/>

    {{ $errors }}
</form>
</section>
