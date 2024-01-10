@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')

{{ session()->get("compte") }}

<script>
    $(document).ready(function() {
        rnd = Math.floor(Math.random() * 3)
        $('.encart-publicitaire2').css("background-image" , "url(../pub2/pub"+rnd+".png)")
        $('.encart-publicitaire2').css("z-index" , "1")
    })
        </script>

<div class="spa"><span class="carte"><a href="{{ url("/carte") }}">🗺️ Ouvrir la carte</a></span></div>

<?php
    $villes = (new App\Models\Ville())->getAllSortedByName(); //Ordre alphabétique
?>

<form class="formindex" id="formindexe" action="{{ route('search') }}" method="GET">
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
    <!-- <label id="datePicker_datedebut" for="datedebut">Date de début :</label>
    <input type="date" name="datedebut" id="datedebut" value="{{ request()->get('datedebut') }}"> -->
    
    <!-- <label for="datefin">Date de fin :</label> 
    <input type="date" name="datefin" id="datefin" value="{{ request()->get('datefin') }}"> -->
    
    <button id="reche" name="reche" type="submit"><b>Rechercher</b></button>
</form>


<h2>Résultats de la recherche pour : location</h2>

@auth
<form class="formindex" id="formsauve" action="{{ route('sauvrecherche') }}" method="POST">
    @csrf

    <button id="sauve" name="sauve" type="submit">Sauvegarder la recherche</button>
    @else
    <form class="formindex" action="{{ route('connect') }}" method="POST">
    @csrf
    <button id="sauve" name="pasco" type="submit">Sauvegarder la recherche</button>
    @endauth
<?php   

use Illuminate\Support\Facades\DB;

$annoncesDB = DB::table('annonce');

// if (isset($_GET['sauve'])) {
//     header("Location: sauvrecherche");
//     exit();
// }
// if (isset($_GET['pasco'])) {
//     header("Location: redirection");
//     exit();
// }

if (isset($_GET['ville']) && $_GET['ville'] !== '') {
    echo "<input style='display:none;' type='text' name='villess' id='villess' value={$_GET['ville']}>";
    $annoncesDB->join('ville','ville.idville','=','annonce.idville')
        ->where('nomville', $_GET['ville']);
}
if (isset($_GET['type_hebergement']) && $_GET['type_hebergement'] !== '') {
    echo "<input style='display:none;' type='text' name='type_hebergementss' id='type_hebergementss' value={$_GET['type_hebergement']}>";
    $annoncesDB->where('idtype', $_GET['type_hebergement']);
}
echo "</form>";





if (isset($_GET['datedebut']) && $_GET['datedebut'] !== '') {
    $annoncesDB->join('reservation', 'reservation.idannonce', '=', 'annonce.idannonce')
        ->where('reservation.datedebut', '>', $_GET['datedebut']);
}

$annonces = $annoncesDB->get();

if ($annonces->isEmpty()) {
    echo "<p>Désolé, nous n’avons pas ça sous la main ! Vous méritez tellement plus qu’une recherche sans résultat! Est-il possible qu’une faute de frappe se soit glissée dans votre recherche ? N’hésitez pas à vérifier !</p>";
} else {
    if ($re != NULL) {
        $annoncesDB->where('titreannonce', 'ILIKE', '%'.$re.'%');
        $annonces = $annoncesDB->get();
    }
    echo "<div class='encart-publicitaire2'><a class='apub' href='https://licorn--projekt.000webhostapp.com/static/static.html'></a></div>";
    echo "<table class='indextable'>";
    $rndea = 0;
    foreach ($annonces as $annonce) {
        if ($annonce->codeetatvalide == TRUE) {
            $rndea++;
           
            // echo "<tr style='display:none;' id='pub' class='pub`.$rndea.`'><td><div class='annonce'><img class='temp1' src='https://tpc.googlesyndication.com/simgad/10071768540348462494?sqp=-oaymwEMCMgBEMgBIAFQAVgB&rs=AOga4qkysVr4wLLhCQNB_8kyHvQMdhGF5Q'></div></td></tr>";
            // echo '<script>';
            // echo 'rnde = Math.floor(Math.random() * 1000);';
            // echo 'if (rnde > 950) {';
            // echo '    console.log(rnde);';
            // echo '    $(".pub'.$rndea.'").css("display","block");';
            // //echo '    $(".pub'.$rndea.'").css("background-image","url(``)");';
            // echo '}';
            // echo '</script>';
            echo "<tr>";
            echo "<td>";
            echo "<div class='annonce'>";
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
            // Convertir la date de format anglophone en objet DateTime
            $dateAnnonce = new DateTime($annonce->dateannonce);

            // Formater la date en format francophone
            $dateAnnonceFormattee = $dateAnnonce->format('d-m-Y');
            echo "<p class='ptitre'>{$dateAnnonceFormattee}</p>";

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
                echo "<a href='/redirection'>";
                echo "<img class='amour' src='/amour/noir.png'>";
            }
            echo "</a>";
            echo "</a>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}
?>

@endsection