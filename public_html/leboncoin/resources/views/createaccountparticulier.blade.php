<?php
    /*require 'vendor/autoload.php';
    use GuzzleHttp\Client;*/
?>
<link rel="stylesheet" type="text/css" href="{{asset('create.css')}}"/> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="flecheretour" onclick="history.back()">←</div>
<div class="titleconnect"><a href="{{ url("/annonce-filtres?ville=&type_hebergement=&datedebut=") }}"><b>LeBonCoin</b></a></div>
<form method="post" action="{{ url("/annonce/save") }}">
@csrf
  {{ session()->get("error") }}

    <div>Nom</div>
    <input name="nom" type="">
    <div>Prenom</div>
    <input name="prenom" type="">
    <div>Email</div>
    <input id="email" name="email" type="">
    <div style="color:red;" id="messageErreurEmail"></div>
    <div>Sexe de naissance</div>
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
    <div style="color:red;" id="messageErreur"></div>
    <input id="" name="mail" type="checkbox"><div>Recevoir des mails commerciaux </div>
    <button id="submitb" type="submit">Créer mon compte</button>

    <script>
            function recupererIdDiv(id) {
                console.log("L'ID de la div est : " + id);
                console.log(document.getElementById(id).innerHTML);
                document.getElementById("adresse").value = document.getElementById(id).innerHTML
            }
        $(document).ready(function() {
            
        let btenvoi = $("#submitb")
        $("#mdp").on("blur", function() {
            console.log("test blur")
            var Reg = new RegExp(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{12,}$/);
            const motDePasse = document.getElementById("mdp").val();
            const messageErreur = document.getElementById("messageErreur");
            if (!Reg.test(motDePasse)) {
            messageErreur.textContent = "Le mot de passe doit comporter au moins 12 caractères comprenant des majuscules, des minuscules, des chiffres et des caractères spéciaux.";
            btenvoi.hide()
        } else {
            messageErreur.textContent = "";
            btenvoi.show()
        }
        })
        $("#email").on("blur", function() {
            console.log("test blur")
            var Reg = new RegExp(/^[^\s@]+@[^\s@]+\.[^\s@]+$/);        
            const email = document.getElementById("email").value;
            const messageErreur = document.getElementById("messageErreurEmail");
            if (!Reg.test(email))   {
                messageErreur.textContent = "L'adresse email n'est pas valide'.";
                btenvoi.hide()
            } else {
                messageErreur.textContent = "";
                btenvoi.show()
            }
        })
            const apiUrl = 'https://geo.api.gouv.fr/communes?codePostal=';
            const format = '&format=json';
            const apiUrlAdresse = "https://api-adresse.data.gouv.fr/search/?q=";
            const limit = /*"&type=name&autocomplete=1"//*/"&limit=8";

            let html = $("html")
            let apiAdr = $("#apiAdr");
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
                        $(errorMessage).text('').hide();
                        var i =0;
                        $.each(results.features, function(key, value) {
                            console.log(results, "results");
                            //console.log(value, key, "value et kes"/*value.features.properties.label*/);
                            $(listA).append('<div class="apiAdr" id="apiAdr'+i+'" onclick="recupererIdDiv(this.id)">'+results.features[i].properties.name+'</div><div class="apiAdr">'+results.features[i].properties.city+'</div><br>')//on ajoute
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
            //console.log(html)
           
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