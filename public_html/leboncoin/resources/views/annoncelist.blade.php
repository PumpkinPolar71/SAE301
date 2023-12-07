@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')
    <?php
    use Illuminate\Support\Facades\DB;

    $annonces = DB::table('annonce')
        ->join('photo', 'photo.idannonce', '=', 'annonce.idannonce')
        ->leftJoin('incident', 'incident.idannonce', '=', 'annonce.idannonce')
        ->where('annonce.idcompte', '=', $id)
        ->select('annonce.*', 'photo.photo', 'incident.commentaire', 'incident.resolu')
        ->get();

    if ($annonces->isEmpty()) {
        echo "<p>Vous n'avez aucune annonce</p>";
    } else {
        echo "<h1>Vos annonces</h1>";
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

            // Affichage des détails de l'incident s'il existe
            if ($annonce->commentaire != NULL) {
                echo "<div class='incident'>";
                echo "<p>Commentaire de l'incident : {$annonce->commentaire}</p>";
                if (!$annonce->resolu) {
                    echo "<form method='post' action='/resolution_incident/{$annonce->idannonce}'>";
                    echo "<input type='hidden' name='_token' value='" . csrf_token() . "' />";
                    echo "<input type='submit' value='Marquer comme résolu' />";
                    echo "</form>";
                } else {
                    echo "<p>Incident résolu</p>";
                }
                echo "</div>";
            }

            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
@endsection