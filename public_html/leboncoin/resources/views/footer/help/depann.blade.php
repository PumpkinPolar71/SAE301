@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment déposer une annonce ?</h1>
    <p>Attention pour déposer une annonce vous devez être connecté, Vous pouvez ensuite cliquer sur un des boutons “Déposer une annonce” </p><br>
    <img src="{{ asset('AidesImages/depannonce.png') }}" ><br>
    <p>Vous avez ensuite plus qu’a remplir les informations pour votre annonce et cliquer sur “Créer annonce” </p><br>
    <p>Attention, l'image que vous déposer est sous forme d'un lien internet !</p><br>
    <img src="{{ asset('AidesImages/creaannonce.png') }}" ><br>

@endsection
