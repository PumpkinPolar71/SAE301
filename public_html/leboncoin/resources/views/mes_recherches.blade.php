
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
                echo "<td>{$recherche->nomrecherche} : {$recherche->nomvilles} : {$recherche->nomtypehebergement}</td><br>";
            }
        }
        if ($verif == 0)  {
            echo "<p>Aucune recherche sauvegardée.</p>";
        }
        echo "</tr>";
    ?>
    <!-- @if(isset($recherches) && count($recherches) > 0)
        <ul>
            @foreach($recherches as $recherche)
                <li>{{ $recherche->NOMRECHERCHE }} - Prix : {{ $recherche->PRIXMIN }} à {{ $recherche->PRIXMAX }}</li>
            @endforeach
        </ul>
    @else
        <p>Aucune recherche sauvegardée.</p>
    @endif -->
@else
<p>Vous devez être connécté pour voir vos recherhces sauvegardées</p>
@endauth

@endsection
