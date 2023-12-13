@extends('layouts.app')

@section('content')
    <h1>Annonces non validées</h1>

    @foreach ($annonces as $annonce)
        <div>
            <p>Annonce ID: {{ $annonce->idannonce }}</p>
            <p>Titre: {{ $annonce->titreannonce }}</p>
            <p>Code et téléphone validés: {{ $annonce->codeetattelvalide ? 'Oui' : 'Non' }}</p>
            <form action="{{ route('gestion.changerStatutValidation') }}" method="POST">
                @csrf
                <input type="hidden" name="annonce_id" value="{{ $annonce->idannonce }}">
                <select name="nouveau_statut">
                    <option value="1">Oui</option>
                    <option value="0">Non</option>
                </select>
                <button type="submit">Mettre à jour le statut</button>
            </form>
        </div>
        <hr>
    @endforeach
@endsection