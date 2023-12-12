@extends('layouts.app')

@section('content')

{{ session()->get("error") }}
<?php
if ($favoris->isEmpty()) {
    echo "<p>Vous n'avez aucun favoris.</p>";
} else {
    echo "<table>";
    $tabann = explode(" ",$favoris->idannonce);
    foreach ($tabann as $i => $value) {
        //if ($annonce->codeetatvalide == False){
            //echo $annonce->codeetatvalide;
            echo "<tr>";
            echo "<td>";
            echo "<a href='/annonce/{$tabann[$i]}'>";
            // foreach ($photos as $photo) {
            //     if ($photo->idphoto == $annonce->idannonce) {
            //         echo "<img class='temp' src='{$photo->photo}'>";
            //         break; 
            //     }
            // }
            echo "<div class='titre'>$tabann[$i]</div>";
            // foreach($villes as $ville) {
            //     if ($ville->idville == $annonce->idville) {
            //         echo "<p class='ptitre'>{$ville->nomville}</p>";
            //         break;
            //     }
            // }
            // echo "<p class='ptitre'>{$annonce->dateannonce}</p>";
            echo "</a>";
            echo "</td>";
            echo "</tr>";
        //}
    }
    echo "</table>";
}
?>
@endsection