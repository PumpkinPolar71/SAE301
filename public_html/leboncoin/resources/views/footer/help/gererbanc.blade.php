@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment gérer mes informations bancaires ?</h1>
    <p>Une fois que vous êtes connecté vous pouvez maintenant voir la nouvelle rebrique “Compte”, nous allons nous dirigez vers celle-ci. </p><br>
    <img src="{{ asset('AidesImages/compteclik.png') }}" ><br>
    <p>Il vous faudra descendre en bas de la page et cliquer sur “Carte bancaire”  </p><br>
    <img src="{{ asset('AidesImages/compte.png') }}" ><br>
    <p>Vous pouvez maintenant ajouter et/ou gérer votre carte bancaire !  </p><br>
    <img src="{{ asset('AidesImages/cartebancaire.png') }}" ><br>
@endsection
