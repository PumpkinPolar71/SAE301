@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')

{{ session()->get("compte") }}
<?php
$reservations = $reservations->get();

if ($reservations->isEmpty()) {
    echo "<p>Vous n'avez aucune réservation</p>";
} else {
    echo "<table>";
    foreach ($reservations as $reservation) {
        echo "<tr>";
        echo "<td>";
        echo "<a href='/reservation/{$reservation->idreservation}'>";
        
        // foreach ($photos as $photo) {
        //     if ($photo->idphoto == $annonce->idannonce) {
        //         echo "<img class='temp' src='{$photo->photo}'>";
        //         break;
        //     }
        // }
        
        echo "<div class='titre'>{$reservations->idreservation}</div>";
        echo "</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

@endsection