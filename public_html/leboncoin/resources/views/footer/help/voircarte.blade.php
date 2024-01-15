@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment voir les annonces sur carte ?</h1>
    <p>Pour pouvoir observer sur la carte les annonces d'une ville il vous 
        suffit de vous rendre tout d'abord de cliquer sur la petite loupe à côté de la barre de recherche en haut de la page  </p><br>
    <img src="{{ asset('AidesImages/Acceuil se co.png') }}" ><br>
    <p> Après avoir il faut cliquer sur le bouton "Ouvrir la carte" puis il vous suffit simplement de choisir une ville et cette derniere apparaitra sur la carte !  </p><br>
    <img src="{{ asset('AidesImages/carte.png') }}" ><br>
    <img src="{{ asset('AidesImages/map.png') }}" ><br>
@endsection
