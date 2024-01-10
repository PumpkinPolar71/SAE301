@extends('layouts.app')

@section('content')

@auth 
    @if (Auth::user()->compte->codeetatcompte == 13 )
<!-- 9 -->
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
                    echo "<div class='annonce'>";
                    echo "<a href='/annonce/{$annonce->idannonce}'>";
                    
                    foreach ($photos as $photo) {
                        if ($photo->idphoto == $annonce->idannonce) {
                            echo "<img class='tempimmo' src='{$photo->photo}'>";
                            break; 
                        }
                    }
                    echo "<div class='titre'>{$annonce->titreannonce}</div>";
                    foreach($villes as $ville) {
                        if ($ville->idville == $annonce->idville) {
                            echo "<p class='ptitre'>{$ville->nomville}</p>";
                            break;
                        }
                    }
                    echo "<p class='ptitre'>{$annonce->dateannonce}</p>";
                    echo "</a>";
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            echo "</table>";
        }
        ?>
        @else
            <p>Vous n'avez pas les autorisations requises pour accéder à cette page, cette incident à été signalé</p>
        @endif
@else 
    <p>Vous n'avez pas les autorisations requises pour accéder à cette page, cette incident à été signalé</p>
@endauth
@endsection