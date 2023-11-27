<link rel="stylesheet" type="text/css" href="{{asset('create.css')}}"/> 
<div class="flecheretour" onclick="history.back()">←</div>
<div class="titleconnect"><a href="{{ url("/annonce-filtres?ville=&type_hebergement=") }}"><b>LeBonCoin</b></a></div>
<style>
    body {
        width: 100%;
        margin-left: 0%;
    }
</style>
<section class="connectsec">
    <div class="bonj"><b>Bonjour !</b></div>
    <div class="conn">Connectez-vous pour découvrir toutes nos fonctionnalités.</div>
    <form method="get" action="{{ url("/login") }}">
    @csrf
    <label>Email *</label><br>
    <input type="text" name="email"/><br>
    <label>Mot de passe *</label><br>
    <input type="password" name="motdepasse"/><br><br>
    <input type="submit" value="connexion"/>
    {{ $errors }}
</form>
<div>Envie de nous rejoindre ? <a href="{{ url("/createaccount") }}"><b>Creer un compte</b></a></div>
</section>
