@extends('layouts.app')

@section('title', 'LeBonCoin')

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@section('content')

{{ session()->get("incident") }}

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

<h2>Propriétaire de l'annonce</h2>
<form id="proprioPost" method="post">

<?php

use Illuminate\Support\Facades\DB;

$annoncesDB = DB::table('particulier');

$annoncesDB->join('annonce','annonce.idcompte','=','particulier.idcompte')
        ->where('particulier.idcompte', $annonce->idcompte);

$annonces = $annoncesDB->get();
$a = 5;
foreach ($annonces as $annonce) {
    if ($a == 5) {
        $nomparticulier = $annonce->nomparticulier;
        $prenomparticulier = $annonce->prenomparticulier;
        echo "<a href='/proprio/".$annonce->idcompte."'>";
        echo "voir";
        echo "</a>";
        $a = 0;
    }

}

?>s
<script>
    $(document).ready(function() {
        const crit = document.getElementById("crit").innerHTML;
        const crite = document.getElementById("crit");
        const char = crit.split(" ")
        crite.innerHTML = "Nombre d'étoile : "+char[0]+"/5"+"\nCapacité : "+char[1]+"\nNombre de chambre : "+char[2]
    })
</script>

<h2>Avis sur cette annonce</h2>
@if ($avis)
    <ul>
        @foreach ($avis as $commentaire)
            <li>
                <p>Commentaire : {{ $commentaire }}</p>
            </li>
        @endforeach
    </ul>
@else
    <p>Aucun avis pour cette annonce pour le moment.</p>
@endif
<h2>Équipements pour cette annonce</h2>
@if ($equipements)
    <ul>
        @foreach ($equipements as $equipement)
            <li>{{ $equipement }}</li>
        @endforeach
    </ul>
@else
    <p>Aucun équipement pour cette annonce pour le moment.</p>
@endif
<hr>
@auth
@if (Auth::user()->compte->codeetatcompte == 9 )
    <h2>Valider l'annonce</h2>
    <form method="POST" action="{{ url("/serviceimmoilier/validatesrv/") }}">
        <div>Annonce conforme</div>
        <input type="radio" value="oui" name="annval">
        <label  for="oui">Oui</label><br>
        <input type="radio" value="non" name="annval">
        <label  for="non">Non</label><br>
        <input type="radio" value="expert" name="annval">
        <label  for="expert">Besoin avis expert</label><br>
        <button id="submitb" type="submit">Valider choix</button>
    </form>
    @endif
@endauth
<!-- Section pour afficher les annonces avec le même premier mot -->
<div class="similar-first-word-ads">
    <h2>Annonces Similaire</h2>
    <div class="row">
        @foreach($similarFirstWordAds as $ad)
            <div class="col-md-3">
                <div class="card">
                    <img src="{{ $ad->photo }}" class="card-img-top" alt="...">
                    <div class="card-body"><a href=/annonce/{{"$ad->idannonce"}}>
                        <h5 class="card-title">{{ $ad->titreannonce }}</h5>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

</form>

</div>
@endsection