<link rel="stylesheet" type="text/css" href="{{asset('style.css')}}"/> 
<div class="flecheretour" onclick="history.back()">←</div>
<div class="titleconnect"><a href="{{ url('/annonces') }}">LeBonCoin</a></div>

<section>
    <div>email</div>
    <input>
    <div>mot de passe</div>
    <input>
    <div><a href="{{ url('/createaccount') }}">créer un compte</a></div>
</section>
