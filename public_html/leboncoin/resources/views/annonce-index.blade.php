@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')

{{ session()->get("compte") }}

<form class="formindex" action="{{ route('search') }}" method="GET">
    <!-- Choisir une ville -->
    <label for="ville">Choisir une ville :</label>
    <select name="ville" id="ville">
        <option value="">Toutes les villes</option>
        @foreach($villes as $ville)
            <option value="{{ $ville->idville }}" {{ request()->get('ville') == $ville->idville ? 'selected' : '' }}>{{ $ville->nomville }}</option>
        @endforeach
    </select>
    
    <!-- Choisir un type d'hébergement -->
    <label for="type_hebergement">Choisir un type d'hébergement :</label>
    <select name="type_hebergement" id="type_hebergement">
        <option value="">Tous les types</option>
        @foreach($typesHebergement as $type)
            <option value="{{ $type->idtype }}" {{ request()->get('type_hebergement') == $type->idtype ? 'selected' : '' }}>{{ $type->type }}</option>
        @endforeach
    </select>
    
    <!-- Choisir une période de disponibilité -->
    <label id="datePicker_datedebut" for="datedebut">Date de début :</label>
    <input type="date" name="datedebut" id="datedebut" value="{{ request()->get('datedebut') }}">
    
    <label for="datefin">Date de fin :</label> 
    <input type="date" name="datefin" id="datefin" value="{{ request()->get('datefin') }}">
    
    <button type="submit">Rechercher</button>
</form>
<?php
$annonces = DB::table('annonce');

if (isset($_GET['ville']) && $_GET['ville'] !== '') {
    $annonces->where('idville', $_GET['ville']);
    foreach ($villes as $ville){
        if ($annonces->idville==$ville->idville){
            $selectedCity = $ville->nomville;
        } 
    }
}
?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('map').setView([46.603354, 1.888334], 6); // Coordonnées de la France et niveau de zoom

    // Utilisation de la carte OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    var selectedCity = "{{ $selectedCity }}"; // Récupérer le nom de la ville depuis le formulaire de recherche

    // Utiliser un service de géocodage (Nominatim) pour obtenir les coordonnées de la ville sélectionnée
    fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + selectedCity)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            if (data.length > 0) {
                var city = data[0];
                L.marker([city.lat, city.lon]).addTo(map).bindPopup(selectedCity);
            }
        })
        .catch(function(error) {
            console.log('Erreur de géocodage :', error);
        });
});
</script>
<h2>Résultats de la recherche pour : location</h2>
<?php
use Illuminate\Support\Facades\DB;

$annonces = DB::table('annonce');

if (isset($_GET['ville']) && $_GET['ville'] !== '') {
    $annonces->where('idville', $_GET['ville']);
    foreach ($villes as $ville){
        if ($annonces->idville==$ville->idville){
            $selectedCity = $ville->nomville;
        } 
    }
}



if (isset($_GET['type_hebergement']) && $_GET['type_hebergement'] !== '') {
    $annonces->where('idtype', $_GET['type_hebergement']);
}

if (isset($_GET['datedebut']) && $_GET['datedebut'] !== '') {
    $annonces->join('reservation', 'reservation.idannonce', '=', 'annonce.idannonce')
        ->where('reservation.datedebut', '>', $_GET['datedebut']);
}

$annonces = $annonces->get();

if ($annonces->isEmpty()) {
    echo "<p>Désolé, nous n’avons pas ça sous la main ! Vous méritez tellement plus qu’une recherche sans résultat! Est-il possible qu’une faute de frappe se soit glissée dans votre recherche ? N’hésitez pas à vérifier !</p>";
} else {
    echo "<table>";
    foreach ($annonces as $annonce) {
        if ($annonce->codeetatvalide == TRUE) {
            echo "<tr>";
            echo "<td>";
            echo "<a href='/annonce/{$annonce->idannonce}'>";
            
            foreach ($photos as $photo) {
                if ($photo->idphoto == $annonce->idannonce) {
                    echo "<img class='temp' src='{$photo->photo}'>";
                    break;
                }
            }
            
            echo "<div class='titre'>{$annonce->titreannonce}</div>";
            foreach($villes as $ville) {
                if ($ville->idville == $annonce->idville) {
                    echo "<p class='ptitre'>{$ville->nomville}</p>";
                    break;
                }
            }
            echo "<a href='/sauvefavoris/{$annonce->idannonce}'>";
            echo "<p class='ptitre'>{$annonce->dateannonce}</p>";
            echo "<img class='amour' src='/amour/noir.png'>";
            echo "</a>";
            echo "</a>";
            echo "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}
?>

@endsection