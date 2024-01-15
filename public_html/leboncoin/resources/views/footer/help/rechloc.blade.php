@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment effectuer une recherche par localisation ?</h1>
    <p>Pour effectuer une recherche par localisation il vous suffit de cliquer sur la petite loupe à côté de la barre de recherche en haut de la page </p><br>
    <img src="{{ asset('AidesImages/Acceuil se co.png') }}" ><br>
    <p> Après avoir fait cela il vous suffit simplement de choisir une ville, de cliquer sur "Rechercher" et vous obtiendrez les annonces situé dans cette dernière.  </p><br>
    <img src="{{ asset('AidesImages/rechercheloc.png') }}" ><br>
@endsection
