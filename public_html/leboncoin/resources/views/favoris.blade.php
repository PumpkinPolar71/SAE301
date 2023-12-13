@extends('layouts.app')

@section('content')

{{ session()->get("error") }}
<?php
if ($favoris == "") {
    echo "<p>Vous n'avez aucun favoris.</p>";
} else {
    echo "<h1>Vos favoris</h1>";
    echo "<table>";
    $tabann = explode(" ",$favoris->libidannonce);
    foreach ($tabann as $i => $value) {
            echo "<tr>";
            echo "<td>";
            echo "<a href='/annonce/{$tabann[$i]}'>";
            foreach ($photos as $photo) {
                if ($photo->idphoto == $tabann[$i]) {
                    echo "<img class='temp' src='{$photo->photo}'>";
                    break; 
                }
            }
            foreach ($annonces as $annonce) {
                if ($annonce->idannonce == $tabann[$i]) {
                    echo "<div class='titre'>$annonce->titreannonce</div>";
                    echo "<a href='/supprfavoris/{$tabann[$i]}'>";
                    echo "<img class='amour' src='/amour/rouge.png'></a>";
                    foreach($villes as $ville) {
                        if ($ville->idville == $annonce->idville) {
                            echo "<p class='ptitre'>{$ville->nomville}</p>";
                            break;
                        }
                    }
                    echo "<p class='ptitre'>{$annonce->dateannonce}</p>";
                }
            }
            echo "</a>";
            echo "</td>";
            echo "</tr>";
        //}
    }
    echo "</table>";
}
?>
@endsection