@extends('layouts.app')

@section('content')


@if(Auth::check()) <!-- Vérifie si l'utilisateur est connecté -->
    <form  method="post" action="{{ url("/annonce/ajouterAnnonce") }}">
        @csrf <!-- Ajoute un token CSRF pour la sécurité -->
        <!-- Titre de l'annonce -->
        <div>
            <label class=ajoutAnnonce for="titreannonce">Titre de l'annonce :</label><br>
            <input class=ajoutAnnonce type="text" name="titreannonce" id="titreannonce">
        </div>

        <!-- Photo de l'annonce -->
        <div>
            <label for="lien_photo">Lien de la photo :</label><br>
            <input class=ajoutAnnonce type="text" name="lien_photo" id="lien_photo">
        </div>
        <!-- Champs pour le formulaire de création d'annonce -->
        <div>
        <h3><label>Condition hébergement</label><br></h3>
            <label for="datearrive">Heure d'arrivée :</label><br>
            <input class=ajoutAnnonce type="time" name="datearrive" id="idconditionh" value="{{ date('Y-m-d') }}"><br>
            <label for="datedepart">Heure de départ :</label><br>
            <input class=ajoutAnnonce type="time" name="datedepart" id="idconditionh" value="{{ date('Y-m-d') }}"><br>
            <label for="fumeur">fumeur</label><br>
            <input class=ajoutAnnonce type="checkbox" name="fumeur" id="idconditionh"><br>
            <label for="animaux">animaux accéptés ?</label><br>
            <input class=ajoutAnnonce type="checkbox" name="animaux" id="idconditionh"><br>
            
            </select>
        </div>

        <!-- Liste déroulante pour la ville -->
        <div>
            <!-- Choisir une ville -->
    <label for="ville">Choisir une ville :</label>
    <select class=ajoutAnnonce name="ville" id="ville">
        <option value="">Toutes les villes</option>
        @foreach($villes as $ville)
            <option value="{{ $ville->idville }}" {{ request()->get('ville') == $ville->idville ? 'selected' : '' }}>{{ $ville->nomville }}</option>
        @endforeach
    </select>
        </div>
    <!-- Choisir un type d'hébergement -->
    <label for="ville">Choisir un type d'hébergement :</label>
    <select class=ajoutAnnonce name="type_hebergement" id="type_hebergement">
        <option value="">Tous les types</option>
        @foreach($typesHebergements as $type)
            <option value="{{ $type->idtype }}">{{ $type->type }}</option>
        @endforeach
    </select>
        <!-- Cases à cocher pour les critères -->
        <div>
            <label>Capacité(nombres de personnes pouvant etre accueillies) :</label><br>
            <input class=ajoutAnnonce type="textbox" name="critere1" id="idcritere"><br>
            <label>Nombres de chambres :</label><br>
            <input class=ajoutAnnonce type="textbox" name="critere2" id="idcritere"><br>
            
            <!-- Ajoute les autres cases à cocher pour les critères -->
        </div>

        <!-- Description de l'annonce -->
        <div>
            <label for="description">Description :</label><br>
            <textarea class=ajoutAnnonce name="description" id="description" rows="4" cols="50"></textarea><br>
        </div>

        <!-- Date automatique -->
        <!-- Date de début date de fin des disponibilités -->
        <form method="get">
            <div id="datesContainer">
                <div>
                    <label for="datedebut[]">De :</label>
                    <input class=ajoutAnnonce type="date" name="datedebut[]" id="idconditionh" value="{{ date('Y-m-d') }}">
                    <label for="datefin[]"> à : </label>
                    <input class=ajoutAnnonce type="date" name="datefin[]" id="idconditionh" value="{{ date('Y-m-d') }}"><br>
                </div>
            </div>
        </form>
        <!-- automatique dans la base de données (current_date) -->
    @csrf
    <label for="prix">Prix :</label>
    <input class=ajoutAnnonce type="number" step="10" name="prix" id="prix" required>
    <!-- <button type="submit">Soumettre</button> -->
<!-- </form><br> -->



@if ($errors->has('prix'))
    <span class="error">{{ $errors->first('prix') }}</span>
@endif
@if ($errors->has('critere1'))
    <span class="error">{{ $errors->first('critere1') }}</span>
@endif

@if ($errors->has('critere2'))
    <span class="error">{{ $errors->first('critere2') }}</span>
@endif        




<!-- Bouton d'ajout dynamique -->
<button type="button" id="ajouterDate">Ajouter une disponibilité</button>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Écoutez l'événement de clic sur le bouton
        let numAjoutDate = 1;
        document.getElementById('ajouterDate').addEventListener('click', function () {
            numAjoutDate += 1;
            //----------------------------------------Prix
            // Créez un label pour le champ de prix
            var labelPrix = document.createElement('label');
            labelPrix.textContent = 'Prix :';
                    
            // Créez un champ de prix
            var champPrix = document.createElement('input');
            champPrix.setAttribute('class', 'ajoutAnnonce');
            champPrix.setAttribute('type', 'number');
            champPrix.setAttribute('step', '10');
            champPrix.setAttribute('name', 'prix');
            champPrix.setAttribute('id', 'prix');
            champPrix.setAttribute('required', '');
                    
            // Créez un conteneur div pour le champ de prix
            var prixContainer = document.createElement('div');
            prixContainer.appendChild(labelPrix);
            prixContainer.appendChild(champPrix);
                    
            // Récupérez le conteneur principal
            var datesContainer = document.getElementById('datesContainer');
                    
            // Insérez le nouveau champ de prix à la fin du conteneur
            datesContainer.appendChild(prixContainer);
            
            //----------------------------------------Dates
            // Créez de nouveaux champs de date
            var nvDateDebut = document.createElement('input');
            nvDateDebut.setAttribute('type', 'date');
            nvDateDebut.setAttribute('class', 'ajoutAnnonce');
            nvDateDebut.setAttribute('name', 'datedebut[]')

            var nvDateFin = document.createElement('input');
            nvDateFin.setAttribute('type', 'date');
            nvDateFin.setAttribute('class', 'ajoutAnnonce');
            nvDateFin.setAttribute('name', 'datefin[]');

            // Créez de nouveaux labels
            var labelDebut = document.createElement('label');
            labelDebut.textContent = 'De : ';

            var labelFin = document.createElement('label');
            labelFin.textContent = ' à : ';

            // Créez un conteneur div pour les nouvelles dates
            var newDateContainer = document.createElement('div');
            newDateContainer.appendChild(labelDebut);
            newDateContainer.appendChild(nvDateDebut);
            newDateContainer.appendChild(labelFin);
            newDateContainer.appendChild(nvDateFin);

            // Récupérez le conteneur principal
            var datesContainer = document.getElementById('datesContainer');

            // Insérez les nouveaux champs à la fin du conteneur
            datesContainer.appendChild(newDateContainer);

            
        });
    });
</script>
<?php
//------------------------------------------DateDebut
    $datesDebutD = $_GET['datedebut[]'];

    if (!empty($datesDebut)) {
        // Initialiser un tableau pour stocker les chaînes de dates
        $chainesDatesD = [];

        // Parcourir chaque élément de $datesDebut
        foreach ($datesDebutD as $dateD) {
            // Vérifier si $dateD est un tableau
            if (is_array($dateD)) {
                // Utiliser implode pour convertir le tableau en chaîne
                $chaineDateD = implode(' ', $dateD);

                // Ajouter la chaîne à $chainesDates
                $chainesDatesD[] = $chaineDateD;
            }
        }

        // Implémenter les chaînes de dates en une seule chaîne
        $chaineDatesDebut = implode(' ', $chainesDatesD);

        // Afficher la chaîne de dates
        echo "<p>Chaîne de dates : $chaineDatesDebut </p>";
    }

    //------------------------------------------DateFin
    $datesFin = request('datefin', []);

    if (!empty($datesFin)) {
        // Initialiser un tableau pour stocker les chaînes de dates
        $chainesDatesF = [];

        // Parcourir chaque élément de $datesDebut
        foreach ($datesFin as $dateF) {
            // Vérifier si $dateF est un tableau
            if (is_array($dateF)) {
                // Utiliser implode pour convertir le tableau en chaîne
                $chaineDateF = implode(' ', $dateF);

                // Ajouter la chaîne à $chainesDatesF
                $chainesDatesF[] = $chaineDateF;
            }
        }

        // Implémenter les chaînes de dates en une seule chaîne
        $chaineDatesFin = implode(' ', $chainesDatesF);

        // Afficher la chaîne de dates
        echo "<p>Chaîne de dates : $chaineDatesFin </p>";
    }
?>
    

    <input style="display: none;" class="ajoutAnnonce" type="date" name="date" id="idconditionh" value="{{ date('Y-m-d') }}"><br>
        <!-- Bouton pour soumettre le formulaire -->
        <button id="submitb" type="submit">Créer annonce</button>
    </form>
@else
    <p>Vous devez être connecté pour créer une annonce.</p>
@endif

<!-- Script JavaScript -->
<script>
    
</script>

@endsection


