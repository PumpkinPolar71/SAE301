<link rel="stylesheet" type="text/css" href="{{asset('create.css')}}"/> 
<div class="flecheretour" onclick="history.back()">←</div>
<div class="titleconnect"><a href="{{ url("/") }}"><b>LeBonCoin</b></a></div>
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
    <input type="text" name="email" required/><br>
    <label>Mot de passe *</label><br>
    <input type="password" name="motdepasse" required/><br><br>
    <input type="submit" value="connexion"/>
    {{ $errors }}
</form>
<div style="margin-bottom:2%;">Envie de nous rejoindre ? <a href="{{ url("/createaccount") }}"><b>Creer un compte</b></a></div>
<a style="font-size:small;" href="creercompte">J'ai oublié mes informations de connection</a>
</section>
