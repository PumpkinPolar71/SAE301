@extends('layouts.app')

@section('content')

<h1 class="h1aide">Réservation</h1>
<ul class="aideredirect">
    <a href="aidecompte"><li>Compte</li></a>
    <a href="aideannonce"><li>Annonce</li></a>
    <a href="aideres"><li>Réservation en ligne</li></a>
    <a href="aiderecherche"><li>Recherches</li></a>
    <a href="aidecookie"><li>Cookie</li></a>
    <a href="aidedonnee"><li>Vos données</li></a>
</ul>
<div class="question">
    <a href="resann">Comment réserver une annonce ?</a>
    <a href="proprioann">Comment contacter le propriétaire ?</a>
    <a href="resprob">Comment signaler un problème sur une réservation ?</a>
    <a href="resrefu">Comment voir les incidents sur ma réservation ?</a>

</div>
@endsection