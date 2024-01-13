@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment voir les incidents sur ma réservation ?</h1>
    <a>Une fois que vous êtes connecté vous pouvez maintenant voir la nouvelle rebrique “Compte”, nous allons nous dirigez vers celle-ci. </a><br>
    <img src="{{ asset('AidesImages/compteclik.png') }}" ><br>
    <a>Il vous faudra descendre en bas de la page et cliquer sur “Incident”  </a><br>
    <img src="{{ asset('AidesImages/comptemodif.png') }}" ><br>
    <a>Vous avez ensuite les incidents qui ont eu lieu sur vos réservations ! </a><br>
    <img src="{{ asset('AidesImages/mesincidents.png') }}" ><br>
@endsection
