@extends('layouts.app')

@section('title', 'LeBonCoin')

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
<h1>{{ $annonce->titreannonce }}</h1>
<p class="dateannonce">{{ $annonce->dateannonce }}</p>
<h2>Description</h2>
<p class="descr">{{ $annonce->description }}</p>
<h2>Critère</h2>
<ul>
    @foreach($criteres as $critere)
        <li id="crit">{{ $critere }}</li>
    @endforeach
</ul>

@endsection

