
@extends('layouts.app')

@section('content')

<h2>Mes recherches</h2>

@if(isset($recherches) && count($recherches) > 0)
    <ul>
        @foreach($recherches as $recherche)
            <li>{{ $recherche->NOMRECHERCHE }} - Prix : {{ $recherche->PRIXMIN }} à {{ $recherche->PRIXMAX }}</li>
        @endforeach
    </ul>
@else
    <p>Aucune recherche sauvegardée.</p>
@endif

@endsection
