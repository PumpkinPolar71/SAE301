@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment réserver une annonce ?</h1>
    <p>Vous devez être connectez pour pouvoir effectuer cette action. </p><br>
    <p>Vous devez d’abord cliquer sur une annonce postée sur le site.  </p><br>
    <img src="{{ asset('AidesImages/acceuil recherche.png') }}" ><br>
    <p>Une fois sur l’annonce il vous suffit de descendre un peu jusqu’au bouton “Réserver”.  </p><br>
    <img src="{{ asset('AidesImages/reserver.png') }}" ><br>
    <p>Après avoir cliqué sur “Réserver” il vous suffit juste de remplir le formulaire de réservation puis de cliquer sur le bouton payer pour passer à l’étape du paiement.  </p><br>
    <img src="{{ asset('AidesImages/resaannonce.png') }}" ><br>
@endsection
