@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment gérer mes réservations ?</h1>
    <a>Une fois que vous êtes connecté vous pouvez maintenant voir la nouvelle rebrique “Compte”, nous allons nous dirigez vers celle-ci. </a><br>
    <img src="{{ asset('AidesImages/compteclik.png') }}" ><br>
    <a>Il vous faudra descendre en bas de la page et cliquer sur “Réservation”  </a><br>
    <img src="{{ asset('AidesImages/comptemodif.png') }}" ><br>
    <a>Vous avez ensuite toutes les réservations que vous avez effectuée ! </a><br>
    <img src="{{ asset('AidesImages/mesresa.png') }}" ><br>
@endsection
