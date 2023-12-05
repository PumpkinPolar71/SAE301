@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')



<?php
$annonce = DB::table('annonce');

    $annonce->join('photo', 'photo.idannonce', '=', 'annonce.idannonce')
    ->where('annonce.idcompte', '=', $id);

$annonces = $annonce->get();

if ($annonces->isEmpty()) {
    echo "<p>Vous n'avez aucune annonce</p>";
} else {
    echo "<h1>Vos annonces</h1>";
    //echo $reservations;
    echo "<table>";
    foreach ($annonces as $annonce) {
        echo "<tr>";
        echo "<td>";
        echo "<a href='/annonce/{$annonce->idannonce}'>";
        if ($annonce->photo != NULL) {
            echo "<img class='temp' src='{$annonce->photo}'>";
        }
        echo "<div class='titre'>{$annonce->titreannonce}</div>";
        echo "</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

@endsection