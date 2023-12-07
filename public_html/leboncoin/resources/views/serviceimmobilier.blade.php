@extends('layouts.app')

@section('content')

{{ session()->get("error") }}
<?php
if ($annonces->isEmpty()) {
    echo "<p>Aucune nouvelle annonce à valider aujourd'hui ! </p>";
} else {
    echo "<table>";
    foreach ($annonces as $annonce) {
        if ($annonce->codeetatvalide == False){
            echo $annonce->codeetatvalide;
            echo "<tr>";
            echo "<td>";
            echo "<a href='/annonce/{$annonce->idannonce}'>";
            
            foreach ($photos as $photo) {
                if ($photo->idphoto == $annonce->idannonce) {
                    echo "<img class='temp' src='{$photo->photo}'>";
                    break; 
                }
            }

            echo "<div class='titre'>{$annonce->titreannonce}</div>";
            echo "</a>";
            echo "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}
?>
@endsection