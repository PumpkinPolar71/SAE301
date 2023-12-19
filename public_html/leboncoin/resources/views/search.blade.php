@extends('layouts.app')

@section('content')



<!-- tentative de recherche par location : -->

<!-- traitement de la recherche et affichage : -->
    <h2>Résultats de la recherche :</h2>

   
        <p>Vous avez recherché : {{ $_POST['search'] }} </p></br>
        <?php
        // echo "<p>Vous avez recherché :".$_POST['search']."</p></br>";
        $nom = $_POST['search'];
        
        
        use Illuminate\Support\Facades\Config;

        $nomDB = Config::get('database.connections.pgsql.database');
        $userDB = Config::get('database.connections.pgsql.username');
        $motDePasse = Config::get('database.connections.pgsql.password');


        $dbconn = pg_connect("host=localhost dbname=$nomDB user=$userDB password=$motDePasse");
        pg_query("set names 'UTF8'");
        pg_query("SET search_path TO leboncoin");

        $query = "SELECT * FROM annonce WHERE titreannonce ILIKE $1";
        $value = "%$nom%";
        $text = pg_query_params($dbconn, $query, array($value));
        //$query = "SELECT titreannonce FROM annonce WHERE titreannonce ILIKE '%$nom%'";
        //$text = pg_query($query);

        echo "<table>";
        if (pg_fetch_assoc($text)!=0) {
        while ($row = pg_fetch_assoc($text)) {
        echo "<tr>";


       /* 
        {{ $annonce->titreannonce }} 
        
     */


        foreach($row as $key=>$value)

        //echo `<a href="url('/annonce/'.$annonce->idannonce)"><td>`.$value."</td>";
        //echo "<img src=''></a></tr>";
        echo `<td>`.$value."</td>";
        echo "</tr>";
        } echo "</table>";
        }
        else {
            echo "<p>Désolé, nous n’avons pas ça sous la main !</p><p>Vous méritez tellement plus qu’une recherche sans résultat !st-il possible qu’une faute de frappe se soit glissée dans votre recherche ? N’hésitez pas à vérifier !</p>";
        }

?>

@endsection