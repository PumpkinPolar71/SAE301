<!-- resources/views/annonces/non-validees.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Annonces non validées</h2>

    @foreach($annoncesNonValidees as $annonce)
        <div>
            <h3>{{ $annonce->TITREANNONCE }}</h3>
            <p>{{ $annonce->DESCRIPTION }}</p>
            <!-- Ajoutez d'autres détails de l'annonce selon vos besoins -->
        </div>
    @endforeach
@endsection
