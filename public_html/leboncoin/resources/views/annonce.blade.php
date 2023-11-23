
@extends('layouts.app')

@section('title', 'LeBonCoin')



@section('content')
<div class="annoncedetail">
<?php
        if ($photo->photo != NULL) {
            echo "<img src='$photo->photo' />";
        } else {
            echo "Oups... Il semblerait que cette annonce ne contienne aucune image.";
        }
    ?>
    <h1>{{ $annonce->titreannonce }}</h2>
    <div class="imagannonce">
    </div>
    <p class="dateannonce">{{ $annonce->dateannonce }}</p>
    <h2>Description</h2>
    <p class="descr">{{ $annonce->description }}</p>
    <h2>Critere</h2>
    <p class="crit">{{ $critere->libellecritere }}</p>
</div>
@endsection
