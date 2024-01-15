@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')



<?php
$reservations = DB::table('reservation');

    $reservations->join('annonce', 'reservation.idannonce', '=', 'annonce.idannonce')
    ->join('photo', 'photo.idannonce', '=', 'annonce.idannonce')
    ->where('reservation.idparticulier', '=', $id);

$reservations = $reservations->get();

if ($reservations->isEmpty()) {
    echo "<p>Vous n'avez aucune réservation</p>";
} else {
    echo "<h1>Vos réservations</h1>";
    //echo $reservations;
    echo "<table>";
    foreach ($reservations as $reservation) {
        echo "<tr>";
        echo "<td>";
        echo "<div class='annonce'>";
        echo "<a href='/reservation/{$reservation->idreservation}'>";
        if ($reservation->photo != NULL) {
            echo "<img class='temp' src='{$reservation->photo}'>";
        }
        echo "<div class='titre'>{$reservation->titreannonce}</div>";
        // foreach($villes as $ville) {
        //     if ($ville->idville == $annonce->idville) {
        //         echo "<p class='ptitre'>{$ville->nomville}</p>";
        //         break;
        //     }
        // }
        echo "<p class='ptitre'>{$reservation->dateannonce}</p>";
        echo "</a>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

@endsection