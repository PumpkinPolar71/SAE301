@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment gérer mes informations bancaires ?</h1>
    <a>Une fois que vous êtes connecté vous pouvez maintenant voir la nouvelle rebrique “Compte”, nous allons nous dirigez vers celle-ci. </a><br>
    <img src="{{ asset('AidesImages/compteclik.png') }}" ><br>
    <a>Il vous faudra descendre en bas de la page et cliquer sur “Carte bancaire”  </a><br>
    <img src="{{ asset('AidesImages/compte.png') }}" ><br>
    <a>Vous pouvez maintenant ajouter et/ou gérer votre carte bancaire !  </a><br>
    <img src="{{ asset('AidesImages/cartebancaire.png') }}" ><br>
@endsection
