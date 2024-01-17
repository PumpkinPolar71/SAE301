
@extends('layouts.app')

@section('content')

<h2>Mes recherches</h2>
@auth
    <?php
    $verif = 0;
  
        echo "<tr>";
        foreach ($recherches as $recherche) {
            if ($recherche->idcompte == Auth::user()->compte->idcompte) {
                $verif = 1;
                echo "<a href='/search?ville=".$recherche->nomvilles."&type_hebergement=".$recherche->nomtypehebergement."&datedebut=&datefin=&reche='><td>{$recherche->nomrecherche} : {$recherche->nomvilles} : {$recherche->nomtypehebergement}</td></a><br>";
            }
        }
        if ($verif == 0)  {
            echo "<p>Aucune recherche sauvegardée.</p>";
        }
        echo "</tr>";
    ?>
@else
<p>Vous devez être connécté pour voir vos recherhces sauvegardées</p>
@endauth

@endsection
