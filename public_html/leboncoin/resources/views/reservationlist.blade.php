@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')

<h1>{{ $reservations->idreservation }}</h1>
<?php
//$reservations = $reservations->get();

if ($reservations->isEmpty()) {
    echo "<p>Vous n'avez aucune réservation</p>";
} else {
    echo "<table>";
    foreach ($reservations as $reservation) {
        if ($reservation->idparticulier == Auth::user()->compte ? Auth::user()->compte->idcompte : 'Non défini') {
        echo "<tr>";
        echo "<td>";
        echo "<a href='/reservation/{$reservation->idreservation}'>";
        
        // foreach ($photos as $photo) {
        //     if ($photo->idphoto == $annonce->idannonce) {
        //         echo "<img class='temp' src='{$photo->photo}'>";
        //         break;
        //     }
        // }
        
        echo "<div class='titre'>{$reservation->message}</div>";
        echo "</a>";
        echo "</td>";
        echo "</tr>";
        } else {echo "<p>Vous n'avez aucune réservation</p>";}
    }
    echo "</table>";
}
?>

@endsection