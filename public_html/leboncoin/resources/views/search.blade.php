
@extends('layouts.app')

@section('title', 'LeBonCoin')



@section('content')

<script>
    function recherche(){
	var t = document.getElementsByClassName("inputText")[0].value; //le[0] permet de voir tous les élements de la liste
	var tb = document.getElementsByClassName("ulAffiche")[0].children ;
	var text = "default";

	
	console.log(text);
	

	for(i=0; i<tb.length;i++){
		if (t.toUpperCase()!= null && t.toUpperCase() != ""  && tb[i].textContent.toUpperCase().indexOf(t.toUpperCase()) == -1){
		}
		
	}
	console.log(t);
	console.log(tb);

	//window.open("/search");
};



console.log("test recherche js");
</script>

<?php

$t =  $_POST["rechercher"];

echo $t;

pg_connect("host=localhost dbname=s224 user=s224 password=1s9yiZ");
pg_query("set names 'UTF8'");
pg_query("SET search_path TO leboncoin");


// $text = pg_query("Select titreannonce FROM annonce WHERE titreannonce LIKE '%'$t'%'");



// echo "<table>";
// while ($row = pg_fetch_assoc($text)) {
// echo "<tr>";
// foreach($row as $key=>$value)
// echo "<td>".$value."</td>";
// echo "</tr>";
// } echo "</table>";

?>

@endsection