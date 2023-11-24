
@extends('layouts.app')

@section('title', 'LeBonCoin')


<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@section('content')
<!-- <div class="annoncedetail"> -->
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
    @if ($photos->isNotEmpty())
        @foreach($photos as $key => $photo)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            <img src="{{ $photo->photo }}" class="d-block w-100" alt="...">
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
@else
<p>Oups... Il semblerait que cette annonce ne contienne aucune image.</p>
@endif

    <h1>{{ $annonce->titreannonce }}</h1>
    <p class="dateannonce">{{ $annonce->dateannonce }}</p>
    <h2>Description</h2>
    <p class="descr">{{ $annonce->description }}</p>
    <h2>Critère</h2>
    <p class="crit">{{ $criteres }}</p>
</div>
@endsection
