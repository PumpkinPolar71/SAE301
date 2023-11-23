@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')

        
<form class="formindex" action="" method="GET">
    <!-- Choisir une ville -->
    <label for="ville">Choisir une ville :</label>
    <select name="ville" id="ville">
        <option value="">Toutes les villes</option>
        @foreach($villes as $id => $ville)
        
            <option value="{{ $id+1 }}">{{ $ville->nomville }}</option>
        @endforeach
    </select>
    
    <!-- Choisir un type d'hébergement -->
    <label for="type_hebergement">Choisir un type d'hébergement :</label>
    <select name="type_hebergement" id="type_hebergement">
        <option value="">Tous les types</option>
        @foreach($typesHebergement as $id => $type_hebergement)
            <option value="{{ $id+1 }}">{{ $type_hebergement->type }}</option>
        @endforeach
        
    </select>
    
    <!-- Choisir une période de disponibilité -->
    <label for="datedebut">Date de début :</label>
    <input type="date" name="datedebut" id="datedebut">
    <label for="datefin">Date de fin :</label>
    <input type="date" name="datefin" id="datefin">
    
    <button type="submit">Rechercher</button>
</form>
<h2>Résultats de la recherche pour :</h2>
    <?php
    //echo  $_GET['ville'];
        pg_connect("host=localhost dbname=s224 user=s224 password=1s9yiZ");
        pg_query("set names 'UTF8'");
        pg_query("SET search_path TO leboncoin");
        if ($_GET['ville']== "" && $_GET['type_hebergement']== "") {
            $query = "SELECT idannonce FROM annonce";
        } elseif ($_GET['ville']== "" && $_GET['type_hebergement']!= "") {
            $test = $_GET['type_hebergement'];
            $query = "SELECT idannonce FROM annonce a 
            Join type_hebergement t on t.idtype = a.idtype
            WHERE a.idtype = $test";
        }
        elseif ($_GET['ville']!= "" && $_GET['type_hebergement']== ""){
            $test = $_GET['ville'];
            $query = "SELECT idannonce FROM annonce a 
            Join ville v on v.idville = a.idville
            WHERE a.idville = $test";
        }
        elseif ($_GET['ville']!= "" && $_GET['type_hebergement']!= ""){
            $test = $_GET['ville'];
            $test2 = $_GET['type_hebergement'];
            $query = "SELECT idannonce FROM annonce a 
            Join ville v on v.idville = a.idville
            Join type_hebergement t on t.idtype = a.idtype
            WHERE a.idville = $test AND a.idtype = $test2";
        }
        elseif ($_GET['ville']== "" && $_GET['type_hebergement']== "" && $_GET['datedebut']!= "" && $_GET['datefin']== "") {
            $test = $_GET['datedebut'];
            $query = "SELECT idreservation FROM reservation r
            WHERE r.datedebut = $test";
            $resultDatedebut = $query;
            $databaseDatedebut = $resultDatedebut->datedebut;
            $carbonDatedebut = Carbon::parse($databaseDatedebut);
            $datedebutFormatFr = $carbonDatedebut->locale('fr')->isoFormat('D MMMM YYYY');
            $query=$datedebutFormatFr;
        }
        else {

        }
        $text = pg_query($query);
   
        // // Supposez que $result soit le résultat de votre requête à la base de données
        // $resultDatedebut = datedebut;
        // $resultDatefin = datefin;

        // // Récupérez la date de la base de données (assurez-vous que votre colonne est de type date ou datetime dans la base de données)
        // $databaseDatedebut = $resultDatedebut->datedebut;
        // $databaseDatefin = $resultDatefin->datefin;

        // // Convertissez la date en objet Carbon
        // $carbonDatedebut = Carbon::parse($databaseDatedebut);
        // $carbonDatefin = Carbon::parse($databaseDatefin);

        // // Changez le format de la date en format francophone
        // $datedebutFormatFr = $carbonDatedebut->locale('fr')->isoFormat('D MMMM YYYY');
        // $datefinFormatFr = $carbonDatefin->locale('fr')->isoFormat('D MMMM YYYY');

        // // $dateFormatFr contient maintenant la date formatée en format francophone
        // echo $datedebutFormatFr;
        // echo $datefinFormatFr;
        

        
       // echo $text;
        echo "<table>";
        //var_dump($text);
        if (pg_fetch_assoc($text)!=0) {
        while ($row = pg_fetch_assoc($text)) {
            echo "<tr>";
            foreach($row as $key=>$value)
                foreach ($annonces as $ann) {
                    if ($ann->idannonce == $value) {
                  
                        echo "<td >";
                        foreach ($photos as $photo) {
                            if ($photo->idphoto == $ann->idannonce) {
                                echo "<img class='temp' src=$photo->photo/>";
                            }
                        }
                        echo "<a href=/annonce/".$ann->idannonce.">";
                        echo $ann->titreannonce;
                        //if ($photos->photo != NULL){echo "<img scr=".$photos->idphoto->idann.">";}
                        echo $ann->idphoto;
                        echo "</a>";
                        echo "</td>";
                 }
            }
            echo "</tr>";
       

            
        // echo "<td>".$value."</td>";
        // echo "</tr>";
        } echo "</table>";
    
        }
        else {
            echo "<p>Désolé, nous n’avons pas ça sous la main !</p><p>Vous méritez tellement plus qu’une recherche sans résultat! Est-il possible qu’une faute de frappe se soit glissée dans votre recherche ? N’hésitez pas à vérifier !</p>";
        }
    ?>
        

@endsection