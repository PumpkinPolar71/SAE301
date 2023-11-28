<?php
    /*require 'vendor/autoload.php';
    use GuzzleHttp\Client;*/
?>
<link rel="stylesheet" type="text/css" href="{{asset('create.css')}}"/> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="flecheretourent" onclick="history.back()">←</div>
<div class="titleconnectent"><a href="{{ url("/annonce-filtres?ville=&type_hebergement=&datedebut=") }}"><b>LeBonCoin</b></a></div>
<form method="post" action="{{ url("/annonce/saveent") }}">
@csrf
  {{ session()->get("error") }}

    <div>SIRET *</div>
    <input id="siret" name="siret" type="">
    <div style="color:red;" id="messageErreurSir"></div>
    <div>Nom de sociéte *</div>
    <input name="nom" type="">
    <div>Secteur d'activité *</div>
    <input name="secteur" type="">
    <div>Code Postal *</div>
    <input id="cp" name="cp" type="">
    <div style="display:none; color:#f55;" id="error-message"></div>
    <div>Ville *</div>
    <select id="ville" name="ville">
    </select>
    <div>Addresse *</div>
    <input name="adresse" type="" id="adresse">
    <div style="" id="listA">
    </div>
    <div>Mot de passe *</div>
    <input name="mdp" id="mdp" type="password">
    <div style="color:red;" id="messageErreur"></div>
    <button id="submitbent" type="submit">Créer mon compte</button>

    <script>
        $(document).ready(function() {
        let btenvoi = $("#submitb")

        $('#siret').on("blur", function() {
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

        $("#mdp").on("blur", function() {
            console.log("test blur")
            var Reg = new RegExp(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{12,}$/);
            const motDePasse = document.getElementById("mdp").value;
            const messageErreur = document.getElementById("messageErreur");
            if (!Reg.test(motDePasse)) {
            messageErreur.textContent = "Le mot de passe doit comporter au moins 12 caractères comprenant des majuscules, des minuscules, des chiffres et des caractères spéciaux.";
            btenvoi.hide()
        } else {
            messageErreur.textContent = "";
            btenvoi.show()
        }
        })
            const apiUrl = 'https://geo.api.gouv.fr/communes?codePostal=';
            const format = '&format=json';
            const apiUrlAdresse = "https://api-adresse.data.gouv.fr/search/?q=";
            const limit = "&type=name&autocomplete=1"//&limit=15";

            let adresse = $("#adresse");
            let zipcode =$("#cp"); 
            let city = $("#ville");
            let listA = $("#listA");
            let errorMessage = $("#error-message");

            $(adresse).on('keyup', function() {
                let codeA = $(this).val(); 
                let urlA = apiUrlAdresse+codeA//+limit//+format; //url serveur
                for (lettre in codeA) {
                    urlA = urlA.replace(' ','%20');
                }
                console.log(urlA);
                //urlA ="https://api-adresse.data.gouv.fr/search/?q=8+bd+du+port&limit=15"
                fetch(urlA, {method: 'get'}).then(response => response.json()).then(results => { //requet
                    //console.log(results)
                    //$(city).find('option').remove(); //on supprime les anciennes
                    if(results.length) {
                        $(errorMessage).text('').hide();
                        $.each(results, function(key, value) {
                            //console.log(value);
                            //console.log(value.nom);
                            $(listA).append('<div value"'+value.name+'">'+value.name+value.postcode+'</div>')//on ajoute
                        })
                    } else {
                        if ($(adresse).val()) {
                            console.log("Erreur de code postal.");
                            $(errorMessage).text('Aucune commune avec ce code postal.').show();
                        } else {
                            $(errorMessage).text('').hide();
                        }
                    }
                 }).catch(err => {
                    console.log(err)
                    $(listA).find('option').remove();
                 })
            })

            
            $(zipcode).on('blur', function() {
                let code = $(this).val();
                let url = apiUrl+code+format; //url serveur
                console.log("test "+url);
                 fetch(url, {method: 'get'}).then(response => response.json()).then(results => { //requet
                    //console.log(results)
                    $(city).find('option').remove(); //on supprime les anciennes
                    if(results.length) {
                        $(errorMessage).text('').hide();
                        $.each(results, function(key, value) {
                            //console.log(value);
                            //console.log(value.nom);
                            $(city).append('<option value"'+value.nom+'">'+value.nom+'</option>')//on ajoute
                        })
                    } else {
                        if ($(zipcode).val()) {
                            console.log("Erreur de code postal.");
                            $(errorMessage).text('Aucune commune avec ce code postal.').show();
                        } else {
                            $(errorMessage).text('').hide();
                        }
                    }
                 }).catch(err => {
                    console.log(err)
                    $(city).find('option').remove();
                 })
            })
        })
    </script>

  
</form>