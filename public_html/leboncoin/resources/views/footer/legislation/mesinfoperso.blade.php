@extends('layouts.app')

@section('content')

@auth

@else
<p>Vous devez être connecté pour accéder à ceci.<a href="connect">Se connecter</a></p>
@endauth

@endsection