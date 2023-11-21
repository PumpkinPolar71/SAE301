@extends('layouts.app')

@section('content')



<!-- tentative de recherche par location : -->

<!-- traitement de la recherche et affichage : -->
    <h2>Résultats de la recherche :</h2>

   
        <p>Vous avez recherché : {{ $_POST['search'] }} </p></br>
        <?php
        // echo "<p>Vous avez recherché :".$_POST['search']."</p></br>";
        $nom = $_POST['search'];
        pg_connect("host=localhost dbname=s224 user=s224 password=1s9yiZ");
        pg_query("set names 'UTF8'");
        pg_query("SET search_path TO leboncoin");

        $query = "SELECT titreannonce FROM annonce WHERE titreannonce ILIKE '%$nom%'";
        $text = pg_query($query);

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