

@extends('layouts.app')

@section('content')
    <h1>Annonces non validées</h1>

    @foreach($annoncesNonValidees as $annonce)
        <div>
            <h3>{{ $annonce->titre }}</h3>
            <p>{{ $annonce->DESCRIPTION }}</p>
            <!-- Ajoutez d'autres détails de l'annonce selon vos besoins -->
        </div>
    @endforeach
@endsection
