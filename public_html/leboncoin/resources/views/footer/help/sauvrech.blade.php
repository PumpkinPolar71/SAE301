@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment sauvegarder une recherche ?</h1>
    <p>Vous devez être connectez pour pouvoir effectuer cette action. Si ce n'est pas le cas, <a href="cocompte">cliquer ici</a></p><br>
    <p>Il vous suffit juste de faire une recherche puis il vous faut cliquer sur le bouton "Sauvegarder Recherche" sur le bas de la page.</p><br>
    <img src="{{ asset('AidesImages/sauvrecherche.png') }}" ><br>
    <p>Une fois que que vous avez cliquer vous serez directement redirigé sur l'onglet "Mes recherches" et vous verrez votre recherche qui sera sauvegardé. </p><br>
    <img src="{{ asset('AidesImages/mesrecherche.png') }}" ><br>
    <p>En cliquant sur votre recherche sauvegarder vous serez redirigé sur la recherche spécifique que vous aviez sauvegarder.</p><br>
    <img src="{{ asset('AidesImages/marecherche.png') }}" ><br>
@endsection
