@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment déposer un avis sur une annonce ?</h1>
    <a>Vous devez être connectez pour pouvoir effectuer cette action. </a><br>
    <a>Vous devez d’abord cliquer sur une annonce postée sur le site.  </a><br>
    <img src="{{ asset('AidesImages/acceuil recherche.png') }}" ><br>
    <a>Une fois sur l’annonce il vous suffit de descendre un peu jusqu’au champ de texte “Avis” puis vous allez écrire votre avis sur l’annonce et cliquer sur le bouton “Enregistrer l’avis” pour pouvoir le poster. </a><br>
    <img src="{{ asset('AidesImages/enregistrer avis.png') }}" ><br>
@endsection
