@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')

{{ session()->get("compte") }}
<form class="formindex" action="" method="GET">
    <!-- Choisir une ville -->
    <label for="ville">Choisir une ville :</label>
    <select name="ville" id="ville">
        <option value="">Toutes les villes</option>
        @foreach($villes as $id => $ville)
            {{$villeSelectionnee = isset($_GET['ville']) ? $_GET['ville'] : null;}}
            <option value="{{ $id + 1 }}" {{  ($id + 1 == $villeSelectionnee) ? 'selected' : '' }}>{{ $ville->nomville }}</option>
        @endforeach
    </select>
    
    <!-- Choisir un type d'hébergement -->
    <label for="type_hebergement">Choisir un type d'hébergement :</label>
    <select name="type_hebergement" id="type_hebergement">
        <option value="">Tous les types</option>
        @foreach($typesHebergement as $id => $type_hebergement)
            <!-- {{$ThSelectionnee = isset($_GET['type_hebergement']) ? $_GET['type_hebergement'] : null;}} -->
            <option value="{{ $id+1 }}" {{  ($id + 1 == $ThSelectionnee) ? 'selected' : '' }}>{{ $type_hebergement->type }}</option>
        @endforeach
        
    </select>
    
    <!-- Choisir une période de disponibilité -->
    <label id="datePicker_datedebut" for="datedebut">Date de début :</label>
    <input type="date" name="datedebut" id="datedebut">

    <label for="datefin">Date de fin :</label>
    <input type="date" name="datefin" id="datefin">
    
    <button type="submit" /*onclick="testerDate()"*/ onkeypress="handleKeyPress(event)">Rechercher</button>
</form>
<h2>Résultats de la recherche pour :</h2>
    <?php
    //echo  $_GET['ville'];

    
    
        use Illuminate\Support\Facades\Config;

        

        $nomDB = Config::get('database.connections.pgsql.database');
        $userDB = Config::get('database.connections.pgsql.username');
        $motDePasse = Config::get('database.connections.pgsql.password');


        pg_connect("host=localhost dbname=$nomDB user=$userDB password=$motDePasse");
        pg_query("set names 'UTF8'");
        pg_query("SET search_path TO leboncoin");
        if ($_GET['ville']== "" && $_GET['type_hebergement']== "") {
            $query = "SELECT idannonce FROM annonce
            WHERE idannonce >= 0";
            $queryid1="SELECT idannonce FROM annonce";

            
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
            $datedebutExist = $_GET['datedebut'];
            $query = "SELECT a.idannonce, r.datedebut FROM annonce a
            JOIN reservation r ON r.idannonce = a.idannonce
            WHERE $datedebutExist <= datedebut
            GROUP BY 1,2";

            //var_dump(pg_fetch_assoc($text));
            $text = pg_query($query);
            if (pg_fetch_assoc($text)/*!=0*/) {
                while ($row = pg_fetch_assoc($text)) {
                    foreach($row as $key=>$value)
                        foreach ($annonces as $ann) {
                            if ($ann->idannonce == $value) {
                                
                            if($datedebutExist < $query)
                            {
                                //---------------------------------------------datedebut de disponibilité
                                $query = "SELECT a.idannonce FROM annonce a
                                JOIN reservation r ON r.idannonce = a.idannonce
                                WHERE $datedebutExist <= datedebut";
                                //------------------------------------------------------------------------
                            }
                            elseif ($datedebutExist != $query)
                            {
                                $query = 0;
                            }
                            else{
                                $query=0;
                            }
                        }
                        }
                    }
            }
            else {
                echo "<p>Désolé, nous n’avons pas ça sous la main !</p><p>Vous méritez tellement plus qu’une recherche sans résultat! Est-il possible qu’une faute de frappe se soit glissée dans votre recherche ? N’hésitez pas à vérifier !</p>";
            }
            
            /*---------------------------*/
            $selectedVille = $request->input('ville');
            $selectedTypeHebergement = $request->input('type_hebergement');
            $query = VilleTypeHebergement::query();
            if ($selectedVille) {
                $query->where('idville', $selectedVille);
            }

            if ($selectedTypeHebergement) {
                $query->where('idtype', $selectedTypeHebergement);
            }
        }
        else {

        }
        $text = pg_query($query);
        echo "<table>";
        if (pg_fetch_assoc($text)/*!=0*/) {
            
            
        while ($row = pg_fetch_assoc($text)) {
          
            
            foreach($row as $key=>$value) {
            echo "<tr>";
                foreach ($annonces as $ann) {
                 
                    if ($ann->idannonce == $value) {
                        echo "<td>";
                        echo "<a href=/annonce/".$ann->idannonce.">";
                        //echo $value ;
                        foreach ($photos as $photo) {
                            if ($photo->idphoto == $ann->idannonce) {
                                $a = 4;
                                echo "<img class='temp' src=$photo->photo>";
                                //echo $photo->idphoto;
                            }
                            // if ($a = 3) {
                            //     echo "Oups... Il semblerait que cette annonce ne contienne aucune image.";
                            // }
                        }
                        echo $ann->titreannonce;
                        //echo $ann->idphoto;
                        echo "</a>";
                        echo "</td>";
                 }
                 echo "</tr>";
            }
        }
        } echo "</table>";
        }
        else {
            echo "<p>Désolé, nous n’avons pas ça sous la main !</p><p>Vous méritez tellement plus qu’une recherche sans résultat! Est-il possible qu’une faute de frappe se soit glissée dans votre recherche ? N’hésitez pas à vérifier !</p>";
        }
    ?>
        

@endsection