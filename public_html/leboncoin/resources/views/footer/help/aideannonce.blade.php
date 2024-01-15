@extends('layouts.app')

@section('content')

<h1 class="h1aide">Annonce</h1>
<ul class="aideredirect">
    <a href="aidecompte"><li>Compte</li></a>
    <a href="aideannonce"><li>Annonce</li></a>
    <a href="aideres"><li>Réservation en ligne</li></a>
    <a href="aiderecherche"><li>Recherches</li></a>
    <a href="aidecookie"><li>Cookie</li></a>
    <a href="aidedonnee"><li>Vos données</li></a>
</ul>
<div class="question">
    <a href="gererann">Comment gérer mes annonces ?</a>
    <a href="depann">Comment déposer une annonce ?</a>
    <a href="proprioann">Comment voir le propriétaire d'une annonce ?</a>
    <a href="partageann">Comment partager une annonce ?</a>
    <a href="depavis">Comment déposer un avis sur une annonce ?</a>
    <a href="sauvann">Comment sauvegarder une annonce ?</a>
    <a href="infoann">Comment voir les différentes informations d'une annonce ?</a>
</div>
@endsection