@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment signaler un problème sur une réservation ?</h1>
    <a>Une fois que vous êtes connecté vous pouvez maintenant voir la nouvelle rebrique “Compte”, nous allons nous dirigez vers celle-ci. </a><br>
    <img src="{{ asset('AidesImages/compteclik.png') }}" ><br>
    <a>Il vous faudra descendre en bas de la page et cliquer sur “Réservation”  </a><br>
    <img src="{{ asset('AidesImages/comptemodif.png') }}" ><br>
    <a>Vous avez ensuite toutes les réservations que vous avez effectuée ! </a><br>
    <img src="{{ asset('AidesImages/mesresa.png') }}" ><br>
    <a>Lorsque vous cliquez sur votre réservation vous pouvez alors remplir le champ de texte dans la section “Signaler un problème” et 
        le soumettre pour qu’il soit ensuite envoyer au propriétaire de l’annonce qui va alors faire son mieux pour le résoudre et/ou vous dédommager. </a><br>
    <img src="{{ asset('AidesImages/signaler pb.png') }}" ><br>
@endsection
