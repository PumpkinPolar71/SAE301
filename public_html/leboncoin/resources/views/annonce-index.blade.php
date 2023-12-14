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
            <option value="{{ $ville->nomville }}" {{ request()->get('ville') == $ville->nomville ? 'selected' : '' }}>{{ $ville->nomville }}</option>
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
    
    <button id="reche" name="reche" type="submit">Rechercher</button>
    <button id="sauve" name="sauve" type="submit">Sauvegarder</button>
</form>
<!-- ------------------------------------------------------------nique tout------------------------------------------------------------------------ -->
<div id="map" style="height: 400px; margin-top:1%;"></div>
<!-- Charger la librairie Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<!-- ======================================================================================================= Parametrage de l'API -->
<script>
    function handleFormSubmission(event) {
        event.preventDefault();

        var selectedCity = document.getElementById('ville').value;
        map.setView([46.603354, 1.888334], 6);

        if (marker !== null) {
            map.removeLayer(marker);
        }

        // Autres opérations liées à la carte Leaflet...

        var buttonClicked = event.submitter.name;

        if (buttonClicked === 'reche') {
            // Code spécifique pour le bouton "Rechercher"
            console.log('Bouton Rechercher cliqué');
            // Autres opérations côté client liées à la recherche...
            
            // Soumettre le formulaire
            event.target.submit();
        } 
    }
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([46.603354, 1.888334], 6); // Coordonnées de la France et niveau de zoom
        var marker = null; // Ajoutez cette ligne pour stocker la référence du marqueur
    
        // Utilisation de la carte OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);
    
        // Capturer l'événement de soumission du formulaire
        document.querySelector('.formindex').addEventListener('submit', handleFormSubmission)
            
        
                        
        
            // Utiliser un service de géocodage (Nominatim) pour obtenir les coordonnées de la ville sélectionnée
            fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + selectedCity + ', France')
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    if (data.length > 0) {
                        var city = data[0];
                        marker = L.marker([city.lat, city.lon]).addTo(map).bindPopup(selectedCity);
                        map.setView([city.lat, city.lon], 10); // Réajuster la vue de la carte pour afficher la ville sélectionnée
                    }
                })
                .catch(function(error) {
                    console.log('Erreur de géocodage :', error);
                });
        });
    });
</script>
<!-- ------------------------------------------------------------nique tout------------------------------------------------------------------------ -->

<h2>Résultats de la recherche pour : location</h2>
<?php

use Illuminate\Support\Facades\DB;

$annoncesDB = DB::table('annonce');

if (isset($_GET['sauve'])) {//------------------------------------------marche pas
    header("Location: route('connect')");
    exit();
}

if (isset($_GET['ville']) && $_GET['ville'] !== '') {
    $annoncesDB->join('ville','ville.idville','=','annonce.idville')
        ->where('nomville', $_GET['ville']);

    
    
}



if (isset($_GET['type_hebergement']) && $_GET['type_hebergement'] !== '') {
    $annoncesDB->where('idtype', $_GET['type_hebergement']);
}

if (isset($_GET['datedebut']) && $_GET['datedebut'] !== '') {
    $annoncesDB->join('reservation', 'reservation.idannonce', '=', 'annonce.idannonce')
        ->where('reservation.datedebut', '>', $_GET['datedebut']);
}

$annonces = $annoncesDB->get();

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
                    echo "<img class='temp1' src='{$photo->photo}'>";
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
            echo "<p class='ptitre'>{$annonce->dateannonce}</p>";
            if (Auth::user() !== NULL) {
                
                foreach ($favoris as $favori) {
                    if ($favori->idcompte == Auth::user()->idcompte) {
                        $tabann = explode(" ",$favori->libidannonce);
                        foreach ($tabann as $i => $value) {
                            if ($tabann[$i] == $annonce->idannonce) {
                                echo "<a href='/supprfavoris/{$annonce->idannonce}'>";
                                echo "<img class='amour' src='/amour/rouge.png'>";
                                break;
                            } else {
                                echo "<a href='/sauvefavoris/{$annonce->idannonce}'>";
                                echo "<img class='amour' src='/amour/noir.png'>";
                            }
                        }
                    }
                }
            } else {
                echo "<a href='/connect'>";
                echo "<img class='amour' src='/amour/noir.png'>";
            }
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