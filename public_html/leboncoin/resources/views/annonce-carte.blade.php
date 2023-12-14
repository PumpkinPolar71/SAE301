@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')

<form class="formindex" action="{{ route('get-annonces') }}" method="GET">
    <!-- Choisir une ville -->
    <label for="ville">Choisir une ville :</label>
    <select name="ville" id="ville">
        <option value="">Toutes les villes</option>
        @foreach($villes as $ville)
            <option data-idville="{{ $ville->idville }}" value="{{ $ville->nomville }}" {{ request()->get('ville') == $ville->nomville ? 'selected' : '' }}>{{ $ville->nomville }}</option>
            
        @endforeach
    </select>
    
    <input type="hidden" name="annonces_ids" id="annonces_ids" value="">

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
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([46.603354, 1.888334], 6); // Coordonnées de la France et niveau de zoom
        var marker = null; // Ajoutez cette ligne pour stocker la référence du marqueur
    
        // Utilisation de la carte OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);
    
        // Capturer l'événement de soumission du formulaire
        document.querySelector('.formindex').addEventListener('submit', function(event) {
            event.preventDefault(); // Empêcher la soumission par défaut du formulaire
        
            var annoncesIds = data.annonces_ids.join(','); // Supposant que les identifiants sont dans un tableau
    document.getElementById('annonces_ids').value = annoncesIds;
    
            // Réinitialiser la carte avant chaque recherche
            map.setView([46.603354, 1.888334], 6);
            if (marker !== null) {
                map.removeLayer(marker);
            }
        
            // var selectedCity = document.getElementById('ville').value; // Récupérer la valeur sélectionnée dans le champ "ville"
            
            var selectedCityElement = document.getElementById('ville');
            var selectedOption = selectedCityElement.options[selectedCityElement.selectedIndex];

            var selectedCity = selectedOption.value;
            var idville = selectedOption.getAttribute('data-idville');

            console.log("Nom de la ville :", selectedCity);
            console.log("ID de la ville :", idville);
        
            // Utiliser un service de géocodage (Nominatim) pour obtenir les coordonnées de la ville sélectionnée
            fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + selectedCity + ', France')
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    if (data.length > 0) {
                        var city = data[0];
                        marker = L.marker([city.lat, city.lon]).addTo(map).bindPopup(selectedCity);
                        marker.setPopupContent(selectedCity + ' - ' + idville);
                        map.setView([city.lat, city.lon], 10); // Réajuster la vue de la carte pour afficher la ville sélectionnée
                        
                    }
                })
                .catch(function(error) {
                    console.log('Erreur de géocodage :', error);
                });

                fetch('/get-annonces', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ idville: idville }),
            })
                    .then(function (response) {
                console.log(response); // Affichez la réponse complète
                return response.json();
            })
            .then(function (data) {
                console.log(data);
                // Manipulez les données récupérées ici
            })
            
            .catch(function (error) {
                console.error('Erreur lors de la récupération des annonces:', error);
                console.log('Contenu de l\'erreur :', error.responseText || error.statusText);
            });
            
        });
    });
</script>
<!-- ------------------------------------------------------------nique tout------------------------------------------------------------------------ -->


@endsection