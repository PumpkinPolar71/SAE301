@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment déposer un avis sur une annonce ?</h1>
    <p>Vous devez être connectez pour pouvoir effectuer cette action. </p><br>
    <p>Vous devez d’abord cliquer sur une annonce postée sur le site.  </p><br>
    <img src="{{ asset('AidesImages/acceuil recherche.png') }}" ><br>
    <p>Une fois sur l’annonce il vous suffit de descendre un peu jusqu’au champ de texte “Avis” puis vous allez écrire votre avis sur l’annonce et cliquer sur le bouton “Enregistrer l’avis” pour pouvoir le poster. </p><br>
    <img src="{{ asset('AidesImages/enregistrer avis.png') }}" ><br>
@endsection
