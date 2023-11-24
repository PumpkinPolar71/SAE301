<?php
    /*require 'vendor/autoload.php';
    use GuzzleHttp\Client;*/
?>
<link rel="stylesheet" type="text/css" href="{{asset('style2.css')}}"/> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<form method="post" action="{{ url("/annonce/save") }}">
@csrf
  {{ session()->get("error") }}

    <div>Nom</div>
    <input name="nom" type="">
    <div>Prenom</div>
    <input name="prenom" type="">
    <div>Email</div>
    <input name="email" type="">
    <div>Genre de naissance</div>
    <input type="radio" value="Homme" name="sexe">
    <label  for="homme">Homme</label>
    <input type="radio" value="Femme" name="sexe">
    <label  for="femme">Femme</label>
    <div>date naissance (JJ-MM-AAAA)</div>
    <input name="date" type="">
    <div>Code Postal</div>
    <input id="cp" name="cp" type="">
    <div style="display:none; color:#f55;" id="error-message"></div>
    <div>Ville</div>
    <select id="ville" name="ville">

    </select>
    <div>Addresse</div>
    <input name="adresse" type="" id="adresse">
    <div style="" id="listA">

    </div>
    <div>Mot de passe</div>
    <input name="mdp" id="mdp" type="password">
    <div id="messageErreur"></div>
    <div id="submitBtn" style="cursor: pointer; background-color: #3498db; color: white; padding: 8px 12px; border-radius: 5px; margin-top: 10px;">Créer mon compte</div>
    <div>Recevoir des mails commerciaux </div><input name="mail" type="checkbox">
    <button type="submit">Créer mon compte</button>

    <script>
       
        $(document).ready(function() {

        $("#mdp").on("blur", function() {
            const regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*()-_+=<>?]).{12,}$/;
            const motDePasse = document.getElementById("mdp").value;
            const messageErreur = document.getElementById("messageErreur");
            if (!regex.test(motDePasse)) {
            messageErreur.textContent = "Le mot de passe doit comporter au moins 12 caractères comprenant des majuscules, des minuscules, des chiffres et des caractères spéciaux.";
            return false;
        } else {
            messageErreur.textContent = "";
            return true;
        }
        })
            //alert('ok on commence');
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