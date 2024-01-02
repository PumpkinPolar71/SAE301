@extends('layouts.app')

@section('content')

<div class="aidetop">
    <b>Comment pouvons nous vous aider ?</b>
</div>
<div class="allaide">
<div onclick="document.location.href='aidecompte';" class="eachaide"><b>Compte</b>
    <p>Découvrez comment gérer votre compte</p></a>
</div>
<div onclick="document.location.href='aideannonce';" class="eachaide"><b>Annonce</b>
    <p>Découvrez comment gérer vos annonces et faire des recherches plus pertinentes selon vos envie</p>
</div>
<div onclick="document.location.href='aideres';" class="eachaide"><b>Réservation en ligne</b>
    <p>Découvrez comment faire une réservation sécurisé</p>
</div>
<div onclick="document.location.href='cookie';" class="eachaide"><b>Cookie</b>
    <p>Découvrez nous gérons les cookies selon vos choix</p>
</div>
<div onclick="document.location.href='aidedonnee';" class="eachaide"><b>Vos données</b>
    <p>Découvrez toutes les informations dont vous avez besoin sur vos données personnelles</p>
</div>
<div onclick="document.location.href='?';" class="eachaide"><b>?</b>
    <p>?</p>
</div>

@endsection