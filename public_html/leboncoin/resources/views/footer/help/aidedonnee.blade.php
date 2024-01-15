@extends('layouts.app')

@section('content')

<h1 class="h1aide">Mes données</h1>
<p>Vous devez être connecté pour avoir accès a vos données personnelles, si ce n,'est pas le cas <a href="cocompte">se connecter</a></p>
<p>Une fois connectée vous devez cliquer sur le bouton compte en haut à droite</p>
<img src="{{ asset('AidesImages/compteclik.png') }}" ><br>
<p>Après vous n'aurez plus qu'à descendre plus bas dans la fenêtre pour voir la rubrique "Mes informations personelles" et cliquer dessus, vous avez maintenant toute vos informations devant vous !</p>
<img src="{{ asset('AidesImages/compte.png') }}" ><br>
@endsection