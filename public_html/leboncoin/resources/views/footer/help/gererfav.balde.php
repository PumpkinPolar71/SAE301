@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment gérer mes favoris ?</h1>
    <p>Vous devez être connectez pour pouvoir effectuer cette action. </p><br>
    <p>Pour sauvegarder une annonce il suffit de la mettre en “Favoris” pour ce faire il vous suffira de cliquer sur le petit cœur ❤️ sur les annonces pour pouvoir l’ajoutez aux favoris.   </p><br>
    <img src="{{ asset('AidesImages/likeavt.png') }}" ><br>
    <p>Pour ensuite voir ces annonces que vous avez mis en favoris il vous suffis de cliquer sur “Favoris” en haut de la page pour voir les annonces que vous avez sauvegarder. </p><br>
    <img src="{{ asset('AidesImages/fav.png') }}" ><br>
    <p>Vous pouvez aussi recliquer sur le cœur qui se remplis lorsque vous le mettez en favoris pour le retirer de vos favoris. </a><br>
    <img src="{{ asset('AidesImages/acceuillike.png') }}" ><br>
@endsection
