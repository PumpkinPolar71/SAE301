@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')

{{ session()->get("compte") }}

<form class="formindex" action="{{ route('search') }}" method="GET">
    <!-- Choisir une ville -->
    <label for="ville">Choisir une ville :</label>
    <select name="ville" id="ville">
        <option value="">Toutes les villes</option>
        @foreach($villes as $ville)
            <option value="{{ $ville->nomville }}" {{ request()->get('ville') == $ville->nomville ? 'selected' : '' }}>{{ $ville->nomville }}</option>
        @endforeach
    </select>
    
    <!-- Choisir un type d'hébergement -->
    <label for="type_hebergement">Choisir un type d'hébergement :</label>
    <select name="type_hebergement" id="type_hebergement">
        <option value="">Tous les types</option>
        @foreach($typesHebergement as $type)
            <option value="{{ $type->idtype }}" {{ request()->get('type_hebergement') == $type->idtype ? 'selected' : '' }}>{{ $type->type }}</option>
        @endforeach
    </select>
    
    <!-- Choisir une période de disponibilité -->
    <label id="datePicker_datedebut" for="datedebut">Date de début :</label>
    <input type="date" name="datedebut" id="datedebut" value="{{ request()->get('datedebut') }}">
    
    <label for="datefin">Date de fin :</label> 
    <input type="date" name="datefin" id="datefin" value="{{ request()->get('datefin') }}">
    
    <button id="reche" name="reche" type="submit">Rechercher</button>
    @auth
    <button id="sauve" name="sauve" type="submit">Sauvegarder</button>
    @else
    <button id="pasco" name="pasco" type="submit">Sauvegarder</button>
    @endauth
</form>

<button><a href="{{ url("/carte") }}">Ouvrir la carte</a></button>
<h2>Résultats de la recherche pour : location</h2>
<?php   

use Illuminate\Support\Facades\DB;

$annoncesDB = DB::table('annonce');

if (isset($_GET['sauve'])) {
    header("Location: sauvrecherche");
    exit();
}
if (isset($_GET['pasco'])) {
    header("Location: redirection");
    exit();
}

if (isset($_GET['ville']) && $_GET['ville'] !== '') {
    $annoncesDB->join('ville','ville.idville','=','annonce.idville')
        ->where('nomville', $_GET['ville']);

    
    
}



if (isset($_GET['type_hebergement']) && $_GET['type_hebergement'] !== '') {
    $annoncesDB->where('idtype', $_GET['type_hebergement']);
}

if (isset($_GET['datedebut']) && $_GET['datedebut'] !== '') {
    $annoncesDB->join('reservation', 'reservation.idannonce', '=', 'annonce.idannonce')
        ->where('reservation.datedebut', '>', $_GET['datedebut']);
}

$annonces = $annoncesDB->get();

if ($annonces->isEmpty()) {
    echo "<p>Désolé, nous n’avons pas ça sous la main ! Vous méritez tellement plus qu’une recherche sans résultat! Est-il possible qu’une faute de frappe se soit glissée dans votre recherche ? N’hésitez pas à vérifier !</p>";
} else {
    echo "<table>";
    foreach ($annonces as $annonce) {
        if ($annonce->codeetatvalide == TRUE) {
            echo "<tr>";
            echo "<td>";
            echo "<a href='/annonce/{$annonce->idannonce}'>";
            
            foreach ($photos as $photo) {
                if ($photo->idphoto == $annonce->idannonce) {
                    echo "<img class='temp1' src='{$photo->photo}'>";
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
            if (Auth::user() !== NULL) {
                
                foreach ($favoris as $favori) {
                    if ($favori->idcompte == Auth::user()->idcompte) {
                        $tabann = explode(" ",$favori->libidannonce);
                        foreach ($tabann as $i => $value) {
                            if ($tabann[$i] == $annonce->idannonce) {
                                echo "<a href='/supprfavoris/{$annonce->idannonce}'>";
                                echo "<img class='amour' src='/amour/rouge.png'>";
                                break;
                            } else {
                                echo "<a href='/sauvefavoris/{$annonce->idannonce}'>";
                                echo "<img class='amour' src='/amour/noir.png'>";
                            }
                        }
                    }
                }
            } else {
                echo "<a href='/connect'>";
                echo "<img class='amour' src='/amour/noir.png'>";
            }
            echo "</a>";
            echo "</a>";
            echo "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}
?>

@endsection