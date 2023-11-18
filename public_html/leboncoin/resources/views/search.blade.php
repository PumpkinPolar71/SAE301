@extends('layouts.app')

@section('content')



<!-- tentative de recherche par location : -->
    
    

<!-- traitement de la recherche et affichage : -->
    <h2>Résultats de la recherche :</h2>

    @if(isset($_POST['search']))
        <p>Vous avez recherché : {{ $_POST['search'] }}</p></br>
        <?php
        $nom = $_POST['search'];
        pg_connect("host=localhost dbname=s224 user=s224 password=1s9yiZ");
        pg_query("set names 'UTF8'");
        pg_query("SET search_path TO leboncoin");

        $query = "SELECT titreannonce FROM annonce WHERE titreannonce ILIKE '%$nom%'";
		$text = pg_query($query);

		echo "<table>";
		while ($row = pg_fetch_assoc($text)) {
		echo "<tr>";
		foreach($row as $key=>$value)
		echo "<td>".$value."</td>";
		echo "</tr>";
		} echo "</table>";
        ?>
    @else
        <p>Aucune recherche effectuée.</p>
    @endif








@endsection