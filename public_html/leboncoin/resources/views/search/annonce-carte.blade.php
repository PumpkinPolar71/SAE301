@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')

<form class="formindex" id="formindexe" action="{{ route('get-annonces') }}" method="GET">
    <!-- Choisir une ville -->
    <label for="ville">Choisir une ville :</label>
    <select name="ville" id="ville">
        <option value="">Toutes les villes</option>
        @foreach($villes as $ville)
            <option data-idville="{{ $ville->idville }}" value="{{ $ville->nomville }}" {{ request()->get('ville') == $ville->nomville ? 'selected' : '' }}>{{ $ville->nomville }}</option>
            
        @endforeach
    </select>
    
    <label for="type_hebergement">Choisir un type d'hébergement :</label>
    <select name="type_hebergement" id="type_hebergement">
        <option value="">Tous les types</option>
        @foreach($typesHebergement as $type)
            <option value="{{ $type->idtype }}" {{ request()->get('type_hebergement') == $type->idtype ? 'selected' : '' }}>{{ $type->type }}</option>
            
        @endforeach
    </select>
    
    <button id="reche" name="reche" type="submit">Rechercher</button>
    <button id="sauve" name="sauve" type="submit">Sauvegarder</button>
</form>

<div id="map" style="height: 400px; margin-top:1%;"></div>
<!-- Charger la librairie Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<!-- ======================================================================================================= Parametrage de l'API -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([46.603354, 1.888334], 6); // Coordonnées de la France et niveau de zoom
        var marker = null; 

        

        
        
    
        // Utilisation de la carte OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);
    
        document.querySelector('.formindex').addEventListener('submit', function(event) {
            event.preventDefault(); // Empêcher la soumission par défaut du formulaire
        
            

            // Réinitialise la carte avant chaque recherche
            map.setView([46.603354, 1.888334], 6);
            if (marker !== null) {
                map.removeLayer(marker);
            }
            
            var selectedCityElement = document.getElementById('ville');
            var selectedOption = selectedCityElement.options[selectedCityElement.selectedIndex];

            var selectedCity = selectedOption.value;
            var idville = selectedOption.getAttribute('data-idville');

            console.log("Nom de la ville :", selectedCity);
            console.log("ID de la ville :", idville);

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
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(function (data) {
                    console.log(data.annonces);

                    var annoncesContainer = document.getElementById('annonces-container');
                    annoncesContainer.innerHTML = ''; // Efface le contenu précédent

                    data.annonces.forEach(function (annonce) {
                        // Création un élément pour chaque annonce (modèle HTML)
                        var annonceElement = document.createElement('div');
                        annonceElement.innerHTML = 
                            '<div class="divAnnnonceCarte">' + '<a href="annonce/' + annonce.idannonce + '">' + 
                            '<h3>' + annonce.idannonce + '</h3>' +
                            '<img class="imgCarte" src="' + annonce.photo + '" alt="Photo de l\'annonce">' +
                            '<h3 class="dataCarte">' + annonce.titreannonce + '</h3>' +
                            '<hp class="dataCarte">' + selectedCity + '</p>' +
                            '<hp class="dataCarte">' + annonce.dateannonce + '</p>' + 
                            '</a>' + '</div>'

                        // Ajout de l'élément au conteneur
                        annoncesContainer.appendChild(annonceElement);
                    });

                    var favoris = favoris.libidannonce
                    var userId = <?php echo Auth::user() ? Auth::user()->idcompte : 'null'; ?>;
                    var annonceId = annonce.idannonce
                            
                    console.log('favoris : ', favoris)
                    console.log('userId : ', userId)
                    console.log('annonceId : ', annonceId)
                    if (userId !== null) {
                    var isFavori = false;

                    // Parcourir la liste des favoris de l'utilisateur
                    data.favoris.forEach(function (favori) {
                        if (favori.idcompte === userId) {
                            var tabann = favori.libidannonce.split(" ");
                        
                            // Parcourir les annonces dans les favoris
                            tabann.forEach(function (value) {
                                if (parseInt(value) === annonceId) {
                                    isFavori = true;
                                }
                            });
                        }
                    });
                
                    var favorisContainer = document.getElementById('annonces-container');
                    var favoriElement = document.createElement('a');
                    favoriElement.href = isFavori ? '/supprfavoris/' + annonceId : '/sauvefavoris/' + annonceId;
                    favoriElement.innerHTML = '<img class="amour" src="/amour/' + (isFavori ? 'rouge.png' : 'noir.png') + '">';
                
                    // Ajouter l'élément au conteneur
                    favorisContainer.appendChild(favoriElement);
                    } else {
                        // Si l'utilisateur n'est pas connecté, afficher l'icône par défaut
                        var favorisContainer = document.getElementById('annonces-container');
                        var favoriElement = document.createElement('a');
                        favoriElement.href = '/connect';
                        favoriElement.innerHTML = '<img class="amour" src="/amour/noir.png">';
                    
                        // Ajouter l'élément au conteneur
                        favorisContainer.appendChild(favoriElement);
                    }
                
                })
                .catch(function (error) {
                    console.error('Erreur lors de la récupération des annonces:', error);
                });
        });
    });
</script>

<div id="annonces-container">
    <style>
        .amour {
            width: 20px; 
            height: 20px;
        }
    </style>
    
</div>




@endsection