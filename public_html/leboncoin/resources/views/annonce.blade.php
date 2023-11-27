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
</div>
<script>
    $(document).ready(function() {
        const crit = document.getElementById("crit").innerHTML;
        const crite = document.getElementById("crit");
        const char = crit.split(" ")
        //console.log(crit, crite) 
        //console.log(char[0],char[1],char[2])
        crite.innerHTML = "Nombre d'étoile : "+char[0]+"/5"+"\nCapacité : "+char[1]+"\nNombre de chambre : "+char[2]
    })
</script>
<h2>Propriétaire de l'annonce</h2>
<form id="proprioPost" method="post">
<p class="proprio">{{ $annonce->idcompte }}</p>
</form>


<?php
use Illuminate\Support\Facades\Config;

$nomDB = Config::get('database.connections.pgsql.database');
$userDB = Config::get('database.connections.pgsql.username');
$motDePasse = Config::get('database.connections.pgsql.password');


pg_connect("host=localhost dbname=$nomDB user=$userDB password=$motDePasse");
pg_query("set names 'UTF8'");
pg_query("SET search_path TO leboncoin");

$query = "SELECT nomparticulier, prenomparticulier FROM particulier p
JOIN annonce a ON a.idcompte=p.idcompte
WHERE p.idcompte = idannonce";

$text = pg_query($query);


var_dump(pg_fetch_assoc($text));

$data = pg_fetch_assoc($text);

if($data){
    $nomparticulier = $data['nomparticulier'];
    $prenomparticulier = $data['prenomparticulier'];

    echo "$nomparticulier $prenomparticulier";
}

?>


<!-- <h2>Critères</h2>
<@if (!empty($criteresIds))
    <ul>
        <li>{{ criteres }}</li>
        /* @foreach ($criteresIds as $critereId)
            <li>{{ $criteresLabels[$critereId] ?? 'Libellé non défini' }}</li>
        @endforeach */
    </ul>
@else 
    <p>Aucun critère trouvé pour cette annonce.</p>
@endif -->

@endsection