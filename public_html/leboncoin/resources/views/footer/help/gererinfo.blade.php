@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment gérer mes informations personnelles ?</h1>
    <a>Une fois que vous êtes connecté vous pouvez maintenant voir la nouvelle rebrique “Compte”, nous allons nous dirigez vers celle-ci. </a><br>
    <img src="{{ asset('AidesImages/compteclik.png') }}" ><br>
    <a>Il vous faudra descendre en bas de la page et cliquer sur “Mes informations personnelles”   </a><br>
    <img src="{{ asset('AidesImages/compte.png') }}" ><br>
    <a>Vous avez maintenant accès à toutes les informations personnelles que vous nous avez renseigné ! !  </a><br>
    <img src="{{ asset('AidesImages/mesinfo perso.png') }}" ><br>
@endsection
