@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment partager une annonce ?</h1>
    <p>Vous devez d’abord cliquer sur une annonce postée sur le site.  </p><br>
    <img src="{{ asset('AidesImages/acceuil recherche.png') }}" ><br>
    <p>Une fois sur l’annonce il vous suffit de descendre un peu jusqu’au “Partager cette annonce” puis cliquer sur le bouton “Partager cette annonce”.  </p><br>
    <img src="{{ asset('AidesImages/annonce2.png') }}" ><br>
    <p>Cette action va vous copier le lien de l’annonce puis vous pouvez ensuite cliquer sur le logo des réseaux sociaux en dessous qui vous redirigera vers ces derniers pour pouvoir partager l’annonce.  </p><br>
@endsection
