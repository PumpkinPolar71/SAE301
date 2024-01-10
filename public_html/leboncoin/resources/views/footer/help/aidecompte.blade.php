@extends('layouts.app')

@section('content')

<h1 class="h1aide">Compte</h1>
<ul class="aideredirect">
    <a href="aidecompte"><li>Compte</li></a>
    <a href="aideannonce"><li>Annonce</li></a>
    <a href="aideres"><li>Réservation en ligne</li></a>
    <a href="aiderecherche"><li>Recherches</li></a>
    <a href=""><li>Cookie</li></a>
    <a href=""><li>Vos données</li></a>
    <a href="?"><li>?</li></a>
</ul>
<div class="question">
    <a href="creercompte">Comment créer mon compte ?</a>
    <a href="cocompte">Comment me connecter à mon compte ?</a>
    <a href="gererann">Comment gérer mes annonces ?</a>
    <a href="gererres">Comment gérer mes réservations ?</a>
    <a href="gererinci">Comment gérer les incidents qui ont lieu dans mes annonces ?</a>
    <a href="gererbanc">Comment gérer mes informations bancaires ?</a>
    <a href="gererinfo">Comment gérer mes informations personnelles ?</a>
    <a href="modifinfo">Comment modifier les informations de mon compte ?</a>
    <a href="deco">Comment me déconnecter de mon compte ?</a>
</div>

@endsection