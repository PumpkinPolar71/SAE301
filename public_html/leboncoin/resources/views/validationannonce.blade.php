@extends('layouts.app')

@section('content')
    <h1>Annonces non vérifiées</h1>

    @foreach($annoncesNonVerifiees as $annonce)
        <div>
            <h3>{{ $annonce->titre }}</h3>
            <p>{{ $annonce->DESCRIPTION }}</p>
            <p>ID Annonce: {{ $annonce->idannonce }}</p>

            @if (!$annonce->CODEETATTELVERIF)
                <form method="post" action="{{ route('validerAnnonce', ['idannonce' => $annonce->idannonce]) }}">
                    @csrf
                    <input type="hidden" name="idannonce" value="{{ $annonce->idannonce }}">
                    <button type="submit">Valider l'annonce</button>
                </form>
            @endif
        </div>
    @endforeach
@endsection
