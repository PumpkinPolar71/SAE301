@extends('layouts.app')

@section('content')

<h1 class="h1aide">Compte</h1>
<ul class="aideredirect">
    <a href="aidecompte"><li>Compte</li></a>
    <a href="aideannonce"><li>Annonce</li></a>
    <a href="aideres"><li>Réservation en ligne</li></a>
    <a href="aiderecherche"><li>Recherches</li></a>
    <a href="cookie"><li>Cookie</li></a>
    <a href="politique"><li>Vos données</li></a>
    <a href="?"><li>?</li></a>
</ul>
<div class="question">
    <a href="">Comment créer mon compte ?</a>
    <a href="">Comment me connecter a mon compte ?</a>
    <a href="">Comment gérer mes annonces ?</a>
    <a href="">Comment gérer mes reservations ?</a>
    <a href="">Comment gérer les incidents qui ont lieu dans mes annonces ?</a>
    <a href="">Comment gérer mes informations bancaires ?</a>
    <a href="">Comment gérer mes informations personnelles ?</a>
    <a href="">Comment modifier les informations de mon compte ?</a>
    <a href="">Comment me déconnecter de mon compte ?</a>
</div>

@endsection