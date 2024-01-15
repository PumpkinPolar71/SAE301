@extends('layouts.app')

@section('content')

<h1 class="h1aide">Recherches</h1>
<ul class="aideredirect">
    <a href="aidecompte"><li>Compte</li></a>
    <a href="aideannonce"><li>Annonce</li></a>
    <a href="aideres"><li>Réservation en ligne</li></a>
    <a href="aiderecherche"><li>Recherches</li></a>
    <a href="aidecookie"><li>Cookie</li></a>
    <a href="aidedonnee"><li>Vos données</li></a>
</ul>
<div class="question">
    <a href="fairerech">Comment faire une recherche ?</a>
    <a href="sauvrech">Comment sauvegarder une recherche ?</a>
    <a href="rechloc">Comment effectuer une recherche par localisation ?</a>
    <a href="rechheb">Comment effectuer une recherche par type d'hebergement ?</a>
    <a href="voircarte">Comment voir les annonces sur la carte ?</a>

</div>
@endsection