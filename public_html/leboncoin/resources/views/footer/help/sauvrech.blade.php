@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment sauvegarder une recherche ?</h1>
    <a>Vous devez être connectez pour pouvoir effectuer cette action. </a><br>
    <a>Il vous suffit juste de faire une recherche puis il vous faut cliquer sur le bouton "Sauvegarder Recherche" sur le bas de la page.</a><br>
    <img src="{{ asset('AidesImages/sauverecherche.png') }}" ><br>
    <a>Une fois que que vous avez cliquer vous serez directement redirigé sur l'onglet "Mes recherches" et vous verrez votre recherche qui sera sauvegardé. </a><br>
    <img src="{{ asset('AidesImages/mesrecherche.png') }}" ><br>
    <a>En cliquant sur votre recherche sauvegarder vous serez redirigé sur la recherche spécifique que vous aviez sauvegarder.</a><br>
    <img src="{{ asset('AidesImages/marecherche.png') }}" ><br>
@endsection
