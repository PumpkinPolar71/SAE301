@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment créer mon compte ?</h1>
<body>

    <a>Cliquer sur le bouton “se connecter”</a><br>
    <img src="{{ asset('AidesImages/seconnecter.png') }}" ><br>
    <a>Puis sur “Créer un compte”

    </a><br>
    <img src="{{ asset('AidesImages/creer compte.png') }}" ><br>
    <a>Vous choisirez si vous voulez ouvrir un compte “pour vous“ ou “votre entreprise”,</a><br>
    <img src="{{ asset('AidesImages/pourvousentre.png') }}" ><br>
    <a>Il ne vous reste plus qu’à entrer vos informations et cliquer sur le bouton “Créer mon compte”, votre compte est maintenant créé si vous avez respecté toutes les consignes !</a><br>
    <img src="{{ asset('AidesImages/creationcompte.png') }}" ><br>

</body>



@endsection