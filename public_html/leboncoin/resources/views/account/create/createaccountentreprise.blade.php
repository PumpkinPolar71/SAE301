<?php
    /*require 'vendor/autoload.php';
    use GuzzleHttp\Client;*/
?>
<link rel="stylesheet" type="text/css" href="{{asset('create.css')}}"/> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Flèche de retour à la page précédente -->
<div class="flecheretourent" onclick="history.back()">←</div>

<!-- Titre du formulaire avec lien vers la page d'accueil -->
<div class="titleconnectent"><a href="{{ url("/annonce-filtres?ville=&type_hebergement=&datedebut=") }}"><b>LeBonCoin</b></a></div>

<!-- Formulaire de création de compte -->
<form method="post" action="{{ url("/saveentaccount") }}">
@csrf
  {{ session()->get("error") }}
    <div>Les champs avec un * sont obligatoires</div>

    <!-- Champ pour le siret -->
    <div>SIRET *</div>
    <input id="siret" name="siret" type="" value="{{ old('siret') }}" required>
    <div style="color:red;" id="messageErreurSir"></div>
    <div style="color: red;">{{ session('errorSiretExist') }}</div>

    <!-- Champ pour le nom de société -->
    <div>Nom de sociéte *</div>
    <input name="nom" type="" value="{{ old('nom') }}" required>
    <div style="color: red;">{{ session('errorSocieteExist') }}</div>

    <!-- Champ pour le secteur d'acticité -->
    <div>Secteur d'activité *</div>
    <input name="secteur" type="" value="{{ old('secteur') }}" required>

    <!-- Champ pour l'adresse (géographique) -->
    <div>Adresse *</div>
    <input name="adresse" type="" id="adresse" value="{{ old('adresse') }}" required>
    <div style="" id="listA">
    </div>

    <!-- Champ pour le code postal -->
    <div>Code Postal *</div>
    <input id="cp" name="cp" readOnly="readOnly" value="{{ old('cp') }}" required>
    <div style="display:none; color:#f55;" id="error-message"></div>

    <!-- Champ pour la ville -->
    <div>Ville *</div>
    <input id="ville" name="ville" readOnly="readOnly" value="{{ old('ville') }}" required>
    <input style="display:none;" id="region" name="region" readOnly="readOnly" value="{{ old('region') }}" required>
    <input style="display:none;" id="dept" name="dept" readOnly="readOnly" value="{{ old('dept') }}" required>

    <!-- Champ pour le mot de passe -->
    <div>Mot de passe *</div>
    <input name="mdp" id="mdp" type="password" required>
    <div id="messageErreur">Le mot de passe doit comporter au moins 12 caractères comprenant au moins une majuscule, une minuscule, un chiffre et un caractère spécial.</div>

    <button id="submitbent" type="submit">Créer mon compte</button>

    <script>
        // Fonction pour récupérer les informations d'une iddiv lors d'un clic
        function recupererIdDiv(id) {
            console.log("L'ID de la div est : " + document.getElementById(id));
            all = document.getElementById(id).innerHTML.split(",")
            console.log(all);
            document.getElementById("adresse").value = all[0]
            document.getElementById("ville").value = all[1]
            document.getElementById("cp").value = all[2]
            document.getElementById("dept").value = all[4]
            document.getElementById("region").value = all[5]
        }
        $(document).ready(function() {
        let btenvoi = $("#submitbent")
        
            // Gestionnaire d'événement pour la validation du siret lors de la saisie
            $('#siret').on("keyup", function() {
                var Reg = new RegExp(/^\d{14}$/);
                const siret = document.getElementById("siret").value;
                const messageErreurSir = document.getElementById("messageErreurSir");
                if (!Reg.test(siret)) {
                messageErreurSir.textContent = "Le SIRET n'est pas valide";
                btenvoi.hide()
            } else {
                messageErreurSir.textContent = "";
                btenvoi.show()
            }
            console.log(siret)
            })

            // Gestionnaire d'événement pour la validation du mot de passe lors de la saisie
            $("#mdp").on("keyup", function() {
                console.log("test blur")
                var Reg = new RegExp(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{12,}$/);
                const motDePasse = document.getElementById("mdp").value;
                console.log(motDePasse,!Reg.test(motDePasse))
                if (!Reg.test(motDePasse)) {
                $("#messageErreur").css("color","red")
                btenvoi.hide()
            } else {
                $("#messageErreur").css("color","black")
                btenvoi.show()
            }
            })
            // Configuration des URL pour les requêtes d'API

            const apiUrl = 'https://geo.api.gouv.fr/communes?codePostal=';
            const format = '&format=json';
            const apiUrlAdresse = "https://api-adresse.data.gouv.fr/search/?q=";
            const limit = /*"&type=name&autocomplete=1"//*/"&limit=12";
            let html = $("html");
            let adresse = $("#adresse");
            let zipcode =$("#cp"); 
            let city = $("#ville");
            let listA = $("#listA");
            let errorMessage = $("#error-message");

            // Gestionnaire d'événement pour la recherche d'adresses lors de la saisie
            $(adresse).on('keyup', function() {
                let codeA = $(this).val(); 
                let urlA = apiUrlAdresse+codeA+limit
                if (codeA.length < 3) {} else {
                    for (lettre in codeA) {
                        urlA = urlA.replace(' ','%20');
                    }
                    console.log(urlA);
                    fetch(urlA, {method: 'get'}).then(response => response.json()).then(results => { 
                        $(listA).find('div').remove(); //on supprime les anciennes
                        $(listA).find('br').remove();
                         if(results.features[0].properties.label != "") {
                            $("#listA").css("display","block")
                            $(errorMessage).text('').hide();
                            var i =0;
                            $.each(results.features, function(key, value) {
                                console.log(results, "results");
                                //console.log(value, key, "value et kes"/*value.features.properties.label*/);
                                $(listA).append('<div class="apiAdr" id="apiAdr'+i+'" onclick="recupererIdDiv(this.id)">'+results.features[i].properties.name+','+results.features[i].properties.city+','+results.features[i].properties.postcode+','+results.features[i].properties.context+'</div>')
                                i++
                            })
                        } else {
                            if ($(adresse).val()) {
                                console.log("Erreur de rue.");
                                $(errorMessage).text('Aucune rue avec ce nom.').show();
                            } else {
                                $(errorMessage).text('').hide();
                            }
                        }
                     }).catch(err => {
                        console.log(err)
                        $(listA).find('option').remove();
                     })
                    }
                })

                // Gestionnaire d'événement pour masquer la liste d'adresses lors du clic en dehors
                $(html).on('click', function() {
                    $("#listA").css("display","none")
                })
        })
    </script>
</form>