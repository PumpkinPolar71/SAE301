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
    <div>Les champs avec un * sont obligatoires</div>
    <div>Nom *</div>
    <input name="nom" type="">
    <div>Prenom *</div>
    <input name="prenom" type="">
    <div>Email *</div>
    <input id="email" name="email" type="">
    <div style="color:red;" id="messageErreurEmail"></div>
    <div>Sexe de naissance *</div>
    <input type="radio" value="Homme" name="sexe">
    <label  for="homme">Homme</label>
    <input type="radio" value="Femme" name="sexe">
    <label  for="femme">Femme</label>
    <div>date naissance (JJ-MM-AAAA) *</div>
    <input id="date" name="date" type="">
    <div style="color:red;" id="messageErreurDate"></div>
    <div>Adresse *</div>
    <input name="adresse" type="" id="adresse">
    <div style="" id="listA">
    </div>
    <div>Code Postal *</div>
    <input id="cp" name="cp" readOnly="readOnly">
    <div style="display:none; color:#f55;" id="error-message"></div>
    <div>Ville *</div>
    <input id="ville" name="ville" readOnly="readOnly">
    <input style="display:none;" id="region" name="region" readOnly="readOnly">
    <input style="display:none;" id="dept" name="dept" readOnly="readOnly">
    <div>Mot de passe *</div>
    <input name="mdp" id="mdp" type="password">
    <div id="messageErreur">Le mot de passe doit comporter au moins 12 caractères comprenant au moins une majuscule, une minuscule, un chiffre et un caractère spécial.</div>
    <input name="mail" type="checkbox"><div id="mail" >Recevoir des mails commerciaux </div>
    <button id="submitb" type="submit">Créer mon compte</button>

    <script>
            function recupererIdDiv(id) {
                console.log("L'ID de la div est : " + document.getElementById(id));
                //console.log(document.getElementById(id).innerHTML);
                all = document.getElementById(id).innerHTML.split(",")
                console.log(all);
                document.getElementById("adresse").value = all[0]
                document.getElementById("ville").value = all[1]
                document.getElementById("cp").value = all[2]
                document.getElementById("dept").value = all[3]
                document.getElementById("region").value = all[4]
            }
        $(document).ready(function() {
        let btenvoi = $("#submitb")

        $("#date").on("keyup", function() {
            const messageErreurDate = document.getElementById("messageErreurDate");
            alldate = document.getElementById("date").value.split("-")
            //console.log(alldate, "all")
            if (alldate[0] <1 || alldate[0] >31 ||alldate[1] <1 || alldate[1] >12 || alldate[2] < 1900 || alldate[2] > 2013) {
                messageErreurDate.textContent = "La date de naissance n'est pas valide.";
                btenvoi.hide()
            } else {
                messageErreurDate.textContent = "";
                btenvoi.show()
            }
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
        $("#email").on("blur", function() {
            console.log("test blur")
            var Reg = new RegExp(/^[^\s@]+@[^\s@]+\.[^\s@]+$/);        
            const email = document.getElementById("email").value;
            const messageErreur = document.getElementById("messageErreurEmail");
            if (!Reg.test(email))   {
                messageErreur.textContent = "L'adresse email n'est pas valide.";
                btenvoi.hide()
            } else {
                messageErreur.textContent = "";
                btenvoi.show()
            }
        })
            const apiUrl = 'https://geo.api.gouv.fr/communes?codePostal=';
            const format = '&format=json';
            const apiUrlAdresse = "https://api-adresse.data.gouv.fr/search/?q=";
            const limit = /*"&type=name&autocomplete=1"//*/"&limit=12";

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
                        $("#listA").css("display","block")
                        $(errorMessage).text('').hide();
                        var i =0;
                        $.each(results.features, function(key, value) {
                            console.log(results, "results");
                            //console.log(value, key, "value et kes"/*value.features.properties.label*/);
                            $(listA).append('<div class="apiAdr" id="apiAdr'+i+'" onclick="recupererIdDiv(this.id)">'+results.features[i].properties.name+','+results.features[i].properties.city+','+results.features[i].properties.context+'</div>')
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
        })
    </script>
</form>