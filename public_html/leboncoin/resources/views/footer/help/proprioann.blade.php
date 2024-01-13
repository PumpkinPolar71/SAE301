@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment voir/contacter le propriétaire d'une annonce ?</h1>
    <a>Vous devez d’abord cliquer sur une annonce postée sur le site.  </a><br>
    <img src="{{ asset('AidesImages/acceuil recherche.png') }}" ><br>
    <a>Une fois sur l’annonce il vous suffit de descendre un peu jusqu’au “Propriétaire de l’annonce” puis cliquer sur le bouton “voir”. </a><br>
    <img src="{{ asset('AidesImages/voirproprio.png') }}" ><br>
    <a>Vous avez donc le profil du propriétaire de l’annonce et vous pouvez ainsi le contacter par mail ! </a><br>
    <img src="{{ asset('AidesImages/profgil.png') }}" ><br>
@endsection
