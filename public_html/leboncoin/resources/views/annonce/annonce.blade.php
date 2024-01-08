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
<?php
// Convertir la date de format anglophone en objet DateTime
$dateAnnonce = new DateTime($annonce->dateannonce);

// Formater la date en format francophone
$dateAnnonceFormattee = $dateAnnonce->format('d-m-Y');
?>

<p class="dateannonce">{{ $dateAnnonceFormattee }}</p>
@auth
    <a href="{{ route('showreservationform', ['idannonce' => $annonce->idannonce]) }}">Réserver</a>
    @else
    <a href="{{ route('redirection') }}">Réserver</a>
@endauth
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

$query = "SELECT nomparticulier, prenomparticulier, p.idcompte FROM particulier p
JOIN annonce a ON a.idcompte=p.idcompte
WHERE p.idcompte = {$annonce->idcompte}";

$text = pg_query($query);

$data = pg_fetch_assoc($text);

if($data){
    $nomparticulier = $data['nomparticulier'];
    $prenomparticulier = $data['prenomparticulier'];
    echo "<a href=/proprio/".$data['idcompte'].">";
    echo "voir";
    echo "</a>";
   // echo "Nom : $nomparticulier\n<br> Prenom : $prenomparticulier";
}

?>

<script>
    $(document).ready(function() {
        const crit = document.getElementById("crit").innerHTML;
        const crite = document.getElementById("crit");
        const char = crit.split(" ")
        const br = document.createElement("br");
        //console.log(crit, crite) 
        //console.log(char[0],char[1],char[2])
        // crite.innerHTML = "Nombre d'étoiles : "+char[0]+"/5"+"\nCapacité : "+char[1]+"\nNombre de chambres : "+char[2]
        crite.innerHTML = "Nombre d'étoiles : " + char[0] + "/5" + br.outerHTML +
                           "Capacité : " + char[1] + br.outerHTML +
                           "Nombre de chambres : " + char[2];
    })
</script>

<h2>Avis sur cette annonce</h2>
@if ($avis)
    <ul>
        @foreach ($avis as $commentaire)
            <li>
                <p>Commentaire : {{ $commentaire }}</p>
                <!-- Autres détails de l'avis -->
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
<h2>Date(s) de dipsonibilité</h2>
<?php
// Sépare les dates de début et de fin par un espace
$datesDebut = explode(' ', $annonce->datedebut);
$datesFin = explode(' ', $annonce->datefin);
$libsPrix = explode(' ', $annonce->libprix);

// Vérifie que le nombre de dates de début est égal au nombre de dates de fin
if (count($datesDebut) !== count($datesFin) || count($datesDebut) !== count($libsPrix)) {
    echo "Erreur : Le nombre de dates de début, de dates de fin, ou de prix ne correspond pas.";
} else {
    // Utilise un index pour accéder à la date de fin et au prix correspondants
    foreach ($datesDebut as $index => $dateDebut) {
        // Converti chaque date de début en objet DateTime
        $dateDebutObj = new DateTime($dateDebut);

        // Format date de début en format francophone
        $dateDebutFormattee = $dateDebutObj->format('d-m-Y');

        // Converti date de fin correspondante en objet DateTime
        $dateFinObj = new DateTime($datesFin[$index]);

        // Format date de fin en format francophone
        $dateFinFormattee = $dateFinObj->format('d-m-Y');

        // Récupère le prix correspondant
        $prix = $libsPrix[$index];

        // Affiche la paire de dates avec le prix
        echo "<p class='datedebut'>De $dateDebutFormattee à $dateFinFormattee au prix de $prix € la nuit.</p>";
    }
}
?>


@auth
     @if (Auth::user()->compte->codeetatcompte == 13)
     <!-- 9 -->
    <h2>Valider l'annonce</h2>
    <form method="POST" action="{{ url('oneann') }}">   <!-- oneann de ServiceController.php -->
        @csrf
        <div>Annonce conforme</div>
        <input type="text" value="{{$annonce->idannonce}}" name="id">   <!-- idannonce -->
        <input type="radio" value="oui" name="annval">                  <!-- Oui -->
        <label  for="oui">Oui</label><br>
        <input type="radio" value="non" name="annval">                  <!-- Non -->
        <label  for="non">Non</label><br>
        <input type="radio" value="expert" name="annval">
        <label  for="expert">Besoin avis expert</label><br>             <!-- besoin d'un avis expert -->
        <button id="submitb" type="submit">Valider choix</button>
    </form>
    @endif
@endauth
<!-- Bouton de partage -->
<h2>Partager cette annonce</h2>
<button  type="button" id="partagerBtn" onclick="Partage()">Partager cette annonce</button>
<script>
    var partagerBtn = document.getElementById('partagerBtn');

    if (partagerBtn) {
        partagerBtn.addEventListener('click', function() {
            navigator.clipboard.writeText(window.location.href);
            alert("Copied the text: " + copyText.value);
        });
    };

    function Partage() {
        alert("attente de passage en https");
        navigator.clipboard.writeText(window.location.href);
    }

</script>
<div class="lepartage">
    <!-- Liens avec les images des logos -->
    <a href="https://www.instagram.com" target="_blank">
        <img src="{{ asset('logopartage/instagram-1581266_640 (1).png') }}" alt="Instagram">
    </a>

    <a href="https://www.snapchat.com" target="_blank">
        <img src="{{ asset('logopartage/Snapchat-Logo.jpg') }}" alt="Snapchat">
    </a>

    <a href="https://www.facebook.com" target="_blank">
        <img src="{{ asset('logopartage/logo-medias-sociaux-bleu_197792-1759.png') }}" alt="Facebook">
    </a>
</div>
<!-- Section pour afficher les annonces avec le même premier mot -->
<div class="similar-first-word-ads">
    <h2>Annonces Similaire</h2>
    <div class="row">
        @foreach($similarFirstWordAds as $ad)
            <div class="col-md-3">
                <div class="card">
                    <img src="{{ $ad->photo }}" class="card-img-top" style="height:150px;" alt="...">
                    <div class="card-body"><a href=/annonce/{{"$ad->idannonce"}}>
                        <h5 class="card-title">{{ $ad->titreannonce }}</h5>
                        <!-- Autres détails de l'annonce si nécessaire echo "<a href=/annonce/".$ann->idannonce.">";-->
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@if(Auth::check())
<!-- Formulaire pour déposer un avis -->
<form method="POST" action="{{ url('annonce/deposerAvis') }}">
    @csrf <!-- Protection CSRF de Laravel -->

    <!-- Champ caché pour l'ID de l'annonce --> 
    <input type="hidden" name="idannonce" value="{{ $annonce->idannonce }}"> <!-- Supposons que $annonce contient les détails de l'annonce actuelle -->

    <!-- Champ de texte pour le commentaire -->
    <input type="text" name="commentaire" placeholder="Avis">
    <button type="submit">Enregistrer l'avis</button>
@method('PUT')

</form>
@else
    <p>Connectez-vous pour laisser un avis.</p>
@endif

@endsection