<?php
    /*require 'vendor/autoload.php';
    use GuzzleHttp\Client;*/
?>
<link rel="stylesheet" type="text/css" href="{{asset('create.css')}}"/> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="flecheretourent" onclick="history.back()">←</div>
<div class="titleconnectent"><a href="{{ url("/annonce-filtres?ville=&type_hebergement=&datedebut=") }}"><b>LeBonCoin</b></a></div>
<form method="post" action="{{ url("/saveentaccount") }}">
@csrf
  {{ session()->get("error") }}
    <div>Les champs avec un * sont obligatoires</div>
    <div>SIRET *</div>
    <input id="siret" name="siret" type="" value="{{ old('siret') }}" required>
    <div style="color:red;" id="messageErreurSir"></div>
    <div style="color: red;">{{ session('errorSiretExist') }}</div>
    <div>Nom de sociéte *</div>
    <input name="nom" type="" value="{{ old('nom') }}" required>
    <div style="color: red;">{{ session('errorSocieteExist') }}</div>
    <div>Secteur d'activité *</div>
    <input name="secteur" type="" value="{{ old('secteur') }}" required>
    <div>Adresse *</div>
    <input name="adresse" type="" id="adresse" value="{{ old('adresse') }}" required>
    <div style="" id="listA">
    </div>
    <div>Code Postal *</div>
    <input id="cp" name="cp" readOnly="readOnly" value="{{ old('cp') }}" required>
    <div style="display:none; color:#f55;" id="error-message"></div>
    <div>Ville *</div>
    <input id="ville" name="ville" readOnly="readOnly" value="{{ old('ville') }}" required>
    <input style="display:none;" id="region" name="region" readOnly="readOnly" value="{{ old('region') }}" required>
    <input style="display:none;" id="dept" name="dept" readOnly="readOnly" value="{{ old('dept') }}" required>
    <div>Mot de passe *</div>
    <input name="mdp" id="mdp" type="password" required>
    <div id="messageErreur">Le mot de passe doit comporter au moins 12 caractères comprenant au moins une majuscule, une minuscule, un chiffre et un caractère spécial.</div>
    <button id="submitbent" type="submit">Créer mon compte</button>

    <script>
                function recupererIdDiv(id) {
                console.log("L'ID de la div est : " + document.getElementById(id));
                //console.log(document.getElementById(id).innerHTML);
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

            $(adresse).on('keyup', function() {
                let codeA = $(this).val(); 
                let urlA = apiUrlAdresse+codeA+limit//+format; //url serveur
                if (codeA.length < 3) {} else {
                for (lettre in codeA) {
                    urlA = urlA.replace(' ','%20');
                }
                console.log(urlA);
                //urlA ="https://api-adresse.data.gouv.fr/search/?q=8+bd+du+port&limit=15"
                fetch(urlA, {method: 'get'}).then(response => response.json()).then(results => { //requet
                    //console.log(results.features[0].properties.label)
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
            $(html).on('click', function() {
                $("#listA").css("display","none")
            })
            // $(zipcode).on('blur', function() {
            //     let code = $(this).val();
            //     let url = apiUrl+code+format; //url serveur
            //     console.log("test "+url);
            //      fetch(url, {method: 'get'}).then(response => response.json()).then(results => { //requet
            //         //console.log(results)
            //         $(city).find('option').remove(); //on supprime les anciennes
            //         if(results.length) {
            //             $(errorMessage).text('').hide();
            //             $.each(results, function(key, value) {
            //                 //console.log(value);
            //                 //console.log(value.nom);
            //                 $(city).append('<option value"'+value.nom+'">'+value.nom+'</option>')//on ajoute
            //             })
            //         } else {
            //             if ($(zipcode).val()) {
            //                 console.log("Erreur de code postal.");
            //                 $(errorMessage).text('Aucune commune avec ce code postal.').show();
            //             } else {
            //                 $(errorMessage).text('').hide();
            //             }
            //         }
            //      }).catch(err => {
            //         console.log(err)
            //         $(city).find('option').remove();
            //      })
            // })
        })
    </script>

  
</form>