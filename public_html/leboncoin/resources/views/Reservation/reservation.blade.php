@extends('layouts.app')

@section('title', 'LeBonCoin')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@section('content')
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @if ($photos->isNotEmpty())
            @foreach($photos as $key => $photo)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ $photo->photo }}" class="d-block w-100" alt="...">
                </div>
            @endforeach
            <!-- Carousel controls -->
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        @else
            <p>Oups... Il semblerait que cette annonce ne contienne aucune image.</p>
        @endif
    </div>
</div>
<p class="">{{ $reservation->datedebut }} - {{ $reservation->datefin }}</p>
<h1>{{$annonce->titreannonce}}</h1>
<h1>Caractéristique</h1>
<div>Nombre d'adulte : {{ $reservation->nbadulte }}</div>
<div>Nombre d'enfant : {{ $reservation->nbenfant }}</div>
<div>Nombre de bébé : {{ $reservation->nbbebe }}</div>
<div>Nombre d'animaux : {{ $reservation->nbanimaux }}</div>
<div>Nombre de nuit : {{ $reservation->nbnuitee }}</div>
<h2>Commentaire</h2>
<p class="descr">{{ $reservation->message }}</p>
<h2>Signaler un problème</h2>

<form method="post" action="{{ url("/annonce/incidentsave/") }}">
    @csrf
    <input type='hidden' name = 'id' value = '{{$reservation->idannonce}}' >
    <!-- Autres champs de formulaire -->
    <input type="text" name="commentaire" placeholder="Commentaire">
    <button type="submit">Soumettre</button>
</form>


@endsection

