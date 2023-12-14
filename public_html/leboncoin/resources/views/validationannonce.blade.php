@extends('layouts.app')

@section('content')
    <h1>Annonces non validées</h1>

    @foreach($annoncesNonValidees as $annonce)
        <div>
            <h3>{{ $annonce->titre }}</h3>
            <p>{{ $annonce->DESCRIPTION }}</p>
            <p>ID Compte: {{ $annonce->idcompte }}</p>

            @if (!$annonce->CODEETATVALIDE)
                <form method="post" action="{{ route('validerAnnonce', ['id' => $annonce->idannonce]) }}">
                    @csrf
                    <input type="hidden" name="idannonce" value="{{ $annonce->idannonce }}">
                    <button type="submit">Valider l'annonce</button>
                </form>
            @endif
        </div>
    @endforeach
@endsection
