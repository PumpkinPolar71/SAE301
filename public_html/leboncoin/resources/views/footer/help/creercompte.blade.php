@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment créer mon compte ?</h1>
<body>

    <p>Cliquer sur le bouton “se connecter”</p><br>
    <img src="{{ asset('AidesImages/seconnecter.png') }}" ><br>
    <p>Puis sur “Créer un compte”

</p><br>
    <img src="{{ asset('AidesImages/creer compte.png') }}" ><br>
    <p>Vous choisirez si vous voulez ouvrir un compte “pour vous“ ou “votre entreprise”,</p><br>
    <img src="{{ asset('AidesImages/pourvousentre.png') }}" ><br>
    <p>Il ne vous reste plus qu’à entrer vos informations et cliquer sur le bouton “Créer mon compte”, votre compte est maintenant créé si vous avez respecté toutes les consignes !</p><br>
    <img src="{{ asset('AidesImages/creationcompte.png') }}" ><br>

</body>



@endsection