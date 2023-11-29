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
    <input type="date" name="datedebut" id="datedebut" value="<?php echo ($_GET['datedebut']) ?> ">
    <script>
    // Récupère le date picker par son ID
    const datePicker = document.getElementById('datedebut');
    
    // Vérifie s'il y a une valeur sauvegardée dans le local storage
    const savedDate = localStorage.getItem('savedDate');
    if (savedDate) {
        // Si une date est sauvegardée, utilise-la dans le date picker
        datePicker.value = savedDate;
    }

    // Fonction pour sauvegarder la valeur du date picker lors de son changement
    datePicker.addEventListener('change', function() {
        localStorage.setItem('savedDate', this.value);
    });
</script>

    <label for="datefin">Date de fin :</label> 
    <input type="date" name="datefin" id="datefin"> 
    <script>
    const datePickerFin = document.getElementById('datefin');
    
    const savedDateFin = localStorage.getItem('savedDateFin');
    if (savedDateFin) {
        datePickerFin.value = savedDateFin;
    }

    datePickerFin.addEventListener('change', function() {
        localStorage.setItem('savedDateFin', this.value);
    });
</script>
    <button type="submit" /*onclick="testerDate()"*/ /*onkeypress="handleKeyPress(event)"*/>Rechercher</button>
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
        
        $query = "";

        if($_GET['ville']== ""){ //ville vide
            if($_GET['type_hebergement'] == ""){ //ville et hebergement sont  vides
                
                if($_GET['datedebut']==""){//ville et hebergement et date debut vides
                    $query = "SELECT a.idannonce FROM annonce a WHERE a.idannonce >= 0";
                }
                else{//ville et hebergement vides et date debut renseignée
                    $query = "SELECT a.idannonce FROM annonce a
                    JOIN reservation r ON r.idannonce = a.idannonce
                    WHERE  r.datedebut > to_date('".$_GET['datedebut']."','YYYY-MM-DD')";
                }
            }
            else{//ville vide hébergement renseigné
                if($_GET['datedebut']==""){//ville vide hebergement renseigne et date debut vide
                    $query = "SELECT a.idannonce FROM annonce a 
                    Join type_hebergement t on t.idtype = a.idtype
                    WHERE a.idtype = ".$_GET['type_hebergement'];
                }
                else{//ville vide et hebergement renseigne et date debut renseignée
                    $query = "SELECT a.idannonce FROM annonce a 
                    Join type_hebergement t on t.idtype = a.idtype
                    JOIN reservation r ON r.idannonce = a.idannonce
                    WHERE a.idtype = ".$_GET['type_hebergement']." and r.datedebut > ".$_GET['datedebut'];
                }
            }
        }
        else{//ville renseignee
            if($_GET['type_hebergement'] == ""){//ville renseignee et hebergement vide
                if($_GET['datedebut']==""){//ville renseignee et hebergement vide et date_debut vide
                    $query = "SELECT a.idannonce FROM annonce a 
                    Join ville v on v.idville = a.idville
                    
                    WHERE a.idville = ".$_GET['ville'];
                }
                else{//ville renseignee et hebergement vide et date_debut renseignee
                    $query = "SELECT a.idannonce FROM annonce a 
                    Join ville v on v.idville = a.idville
                    JOIN reservation r ON r.idannonce = a.idannonce
                    WHERE a.idville = ".$_GET['ville']." and r.datedebut > to_date('".$_GET['datedebut']."','YYYY-MM-DD')";
                }
            }
            else{//ville renseignee hebergement renseigne
                if($_GET['datedebut']==""){//ville renseignee hebergement renseigne et date debut vide
                    $query = "SELECT a.idannonce FROM annonce a 
                    Join ville v on v.idville = a.idville
                    Join type_hebergement t on t.idtype = a.idtype
                    WHERE a.idville = ".$_GET['ville']." AND a.idtype = ".$_GET['type_hebergement'];
                }
                else{//ville renseignee hebergement renseigne et date debut renseigne
                    $query = "SELECT a.idannonce FROM annonce a 
                    Join ville v on v.idville = a.idville
                    Join type_hebergement t on t.idtype = a.idtype
                    JOIN reservation r ON r.idannonce = a.idannonce
                    WHERE a.idville = ".$_GET['ville']." AND a.idtype = ".$_GET['type_hebergement']." and r.datedebut > to_date('".$_GET['datedebut']."','YYYY-MM-DD')";
                }
            }

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