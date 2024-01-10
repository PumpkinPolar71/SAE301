@extends('layouts.app')

@section('content')

<h1 class="h1aide">Réservation</h1>
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
    <a href="resann">Comment réserver une annonce ?</a>
    <a href="resrefu">Un propriétaire peut-il refuser une demande de réservation ?</a>
    <a href="proprioann">Comment contacter le propriétaire ?</a>
    <a href="resprob">Comment signaler un problème sur une réservation ?</a>

</div>
@endsection