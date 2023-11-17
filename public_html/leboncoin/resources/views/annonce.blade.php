
@extends('layouts.app')

@section('title', 'LeBonCoin')



@section('content')
<h2>Annonce : {{ $annonce->name }}</h2>
<p>{{ $annonce }}</p>

<p><a href="{{ url("annonces") }}">Retour...</a></p>


@endsection
