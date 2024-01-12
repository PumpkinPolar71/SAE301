@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment modifier les informations de mon compte ?</h1>
    <a>Une fois que vous êtes connecté vous pouvez maintenant voir la nouvelle rebrique “Compte”, nous allons nous dirigez vers celle-ci. </a><br>
    <img src="{{ asset('AidesImages/compteclik.png') }}" ><br>
    <a>Vous tombez alors directement sur votre profil et vous pouvez directement modifier les informations de votre compte.  
        Il vous faut d’abord cliquer sur le bouton “Modifier” puis vous modifier l’information que vous avez choisis et pour valider cette modification il suffit de cliquer sur “Envoyer”.     </a><br>
    <img src="{{ asset('AidesImages/comptemodif.png') }}" ><br>
@endsection
