@extends('layouts.app')

@section('content')

        
<form action="" method="GET">
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
        @foreach($villes as $id => $ville)
            <option value="{{ $id }}">{{ $ville->nomville }}</option>
        @endforeach
        
    </select>
    
    <!-- Choisir une période de disponibilité -->
    <!-- <label for="datedebut">Date de début :</label>
    <input type="date" name="datedebut" id="datedebut">
    <label for="datefin">Date de fin :</label>
    <input type="date" name="datefin" id="datefin"> -->
    
    <button type="submit">Rechercher</button>
</form>
<h2>Résultats de la recherche :</h2>

   
    <?php
        pg_connect("host=localhost dbname=s224 user=s224 password=1s9yiZ");
        pg_query("set names 'UTF8'");
        pg_query("SET search_path TO leboncoin");
        if ($_GET['ville']== "") {
            $query = "SELECT titreannonce FROM annonce
                    ";
        }

            //echo "a".$_GET['ville']."a";
           $test = $_GET['ville'];
           //echo $test;
            //$request->input("ville") = $recherhce;
        // $nom = $_GET['annonce-index'];
        

        $query = "SELECT titreannonce FROM annonce a 
                    Join ville v on v.idville = a.idville
                    WHERE a.idville = $test";
        $text = pg_query($query);

        echo "<table>";
        if (pg_fetch_assoc($text)!=0) {
        while ($row = pg_fetch_assoc($text)) {
        echo "<tr>";


        foreach($row as $key=>$value)
        echo "<td>".$value."</td>";
        echo "</tr>";
        } echo "</table>";
    
        }
        else {
            echo "<p>Désolé, nous n’avons pas ça sous la main !</p><p>Vous méritez tellement plus qu’une recherche sans résultat! Est-il possible qu’une faute de frappe se soit glissée dans votre recherche ? N’hésitez pas à vérifier !</p>";
        }//}
    ?>
        

@endsection