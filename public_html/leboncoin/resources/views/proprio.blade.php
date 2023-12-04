@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')
<div class="bandeau">
    <?php
        $nomDB = Config::get('database.connections.pgsql.database');
        $userDB = Config::get('database.connections.pgsql.username');
        $motDePasse = Config::get('database.connections.pgsql.password');
        pg_connect("host=localhost dbname=$nomDB user=$userDB password=$motDePasse");
        pg_query("set names 'UTF8'");
        pg_query("SET search_path TO leboncoin");

        //---------------------------------------------------------Pdp
        $nom = $proprio->nomparticulier;
        $prenom = $proprio->prenomparticulier;

        // Récupérer les premières lettres
        $premiereLettreNom = substr($nom, 0, 1);
        $premiereLettrePrenom = substr($prenom, 0, 1);

        echo "<div class='pdp'><p class='pPseudo'>$premiereLettrePrenom</p></div><br>";
        
        //---------------------------------------------------------Pseudo
        // Afficher les premières lettres
        echo "<br><h1>Pseudonyme : $premiereLettreNom"."$premiereLettrePrenom</h1>";
        


        //---------------------------------------------------------Adresse email
        $idAnnonce = $annonces->idannonce;

        $query = "SELECT email FROM compte c
                  JOIN annonce a ON a.idcompte=c.idcompte
                  WHERE a.idannonce = $idAnnonce";

        $result = pg_query($query);

        if ($result) {
            $row = pg_fetch_assoc($result);
            $email = $row['email'];
            echo "<h1>Adresse email : $email</h1>";
        } else {
            echo "<h1>Adresse email non définie</h1>";
        }

        //---------------------------------------------------------Departement
        $idAnnonce = $annonces->idannonce;
        $idCompte = $annonces->idcompte;
        $idVille = $compte->idville;
        $idDepartement = $ville->iddepartement;

        $query = "SELECT nomdepartement FROM departement d
                  JOIN ville v ON v.iddepartement = d.iddepartement
                  JOIN compte c ON v.idville = c.idville
                  JOIN annonce a ON c.idcompte = a.idcompte
                  WHERE a.idannonce = $idAnnonce AND c.idcompte = $idCompte AND v.idville = $idVille AND d.iddepartement = $idDepartement";

        $result = pg_query($query);

        if ($result !== false) {
            $row = pg_fetch_assoc($result);
            if ($row !== false && isset($row['nomdepartement'])) {
                $dep = $row['nomdepartement'];
                echo "<h1>Département : $dep</h1>";
            } else {
                echo "<h1>Département non défini</h1>";
            }
        } else {
            echo "<h1>Erreur dans la requête SQL</h1>";
        }
    
    ?>
    <h1>{{$proprio->nomville}}

</div>
@endsection