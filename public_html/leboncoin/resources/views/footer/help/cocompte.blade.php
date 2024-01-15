@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment me connecter à mon compte ?</h1>
<body>

    <p>Cliquer sur le bouton “se connecter”</p><br>
    <img src="{{ asset('AidesImages/seconnecter.png') }}" ><br>
    <p>Il vous suffit ensuite d’entrer votre email ainsi que le mot de passe que vous avez choisis lors de la création de votre compte ! </p><br>
    <p>Si vous n'avez pas de compte ou avez oublier le mot de passe, <a href="creercompte">cliquer ici</a></p><br>
    <img src="{{ asset('AidesImages/co.png') }}" ><br>
    
</body>
@endsection