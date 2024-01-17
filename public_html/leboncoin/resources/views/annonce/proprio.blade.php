@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')
<div class="bandeau">
    <?php

        //---------------------------------------------------------Pdp
        foreach ($particuliers as $particulier) {
            if ($particulier->idcompte == $compte->idcompte) {
                $nom = $particulier->nomparticulier;
                $prenom = $particulier->prenomparticulier;
            }
        }


        // Récupérer les premières lettres
        $premiereLettreNom = substr($nom, 0, 1);
        $premiereLettrePrenom = substr($prenom, 0, 1);

        echo "<div class='pdp'><p class='pPseudo'>$premiereLettrePrenom</p></div><br>";
        
        //---------------------------------------------------------Pseudo
        // Afficher les premières lettres
        echo "<br><h1>Pseudonyme : $premiereLettreNom"."$premiereLettrePrenom</h1>";
        


        //---------------------------------------------------------Adresse email
        // $idAnnonce = $annonces->idannonce;

        // $query = "SELECT email FROM compte c
        //           JOIN annonce a ON a.idcompte=c.idcompte
        //           WHERE a.idannonce = $idAnnonce";

        // $result = pg_query($query);

        // if ($result) {
        //     $row = pg_fetch_assoc($result);
        //     $email = $row['email'];
        //     echo "<h1>Adresse email : $email</h1>";
        // } else {
        //     echo "<h1>Adresse email non définie</h1>";
        // }
        echo "<h1>Adresse email : ".$compte->email."</h1>";
        //---------------------------------------------------------Departement

        foreach ($villes as $ville) {
            if ($compte->idville == $ville->idville) {
                foreach($departements as $departement) {
                    if ($departement->iddepartement == $ville->iddepartement) {
                        echo "<h1>Département : $departement->nomdepartement</h1>";
                    }
                }
            }
        }
    ?>
    <h1>

</div>
@endsection