
@extends('layouts.app')

@section('title', 'NageWaza')



@section('content')
<h2>Annonce : {{ $annonce->name }}</h2>
<p>{{ $annonce }}</p>

<p><a href="{{ url("annonce") }}">Retour...</a></p>


@endsection
