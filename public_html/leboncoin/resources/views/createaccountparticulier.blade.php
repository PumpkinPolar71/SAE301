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
    <div>civilité</div>
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
    <input name="rue" type=""id="adresseInput">

    <div>Mot de passe</div>
    <input name="mdp" type="password">
    <div>Recevoir des mails commerciaux </div><input name="mail" type="checkbox">
    
    <script>
        $(document).ready(function() {
            //alert('ok on commence');
            const apiUrl = 'https://geo.api.gouv.fr/communes?codePostal=';
            const format = '&format=json';

            let zipcode =$("#cp"); 
            let city = $("#ville");
            let errorMessage = $("#error-message");

            $(zipcode).on('blur', function() {
                let code = $(this).val();
                let url = apiUrl+code+format; //url serveur
                //console.log(url);
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

    <button type="submit">Créer mon compte</button>
</form>