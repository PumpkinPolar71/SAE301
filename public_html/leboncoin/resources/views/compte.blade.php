@extends('layouts.app')

@section('content')
    @auth
        <div class="bandeau">
            <div class="pdp"><p class="pDeMrd">Q</p></div><br>
            <div id="container">
                <h1></h1><br>
            <!-- <h1>Votre ID de compte : {{ Auth::user()->compte ? Auth::user()->compte->idcompte : 'Non défini' }}</h1> -->
                <label for="email">Votre email : </label>
                <span class="valeurEmail">{{ Auth::user()->compte ? Auth::user()->compte->email : 'Non défini' }}</span>
                <input type="text" id="email" style="display: none;">
                <button id="modifierEmail">Modifier</button>

                <h2>Votre Adresse : {{ Auth::user()->compte ? Auth::user()->compte->adresseruecompte : 'Non défini' }}, {{ Auth::user()->compte ? Auth::user()->compte->adressecpcompte : 'Non défini' }}, {{ Auth::user()->ville ? Auth::user()->ville->nomville : 'Non défini' }}</h2>
                <!-- <h2>Votre Adresse cp : {{ Auth::user()->compte ? Auth::user()->compte->adressecpcompte : 'Non défini' }}</h2> -->
                @if (Auth::user()->particulier)
                    <h2>Votre nom : {{ Auth::user()->particulier->nomparticulier ? Auth::user()->particulier->nomparticulier : 'Non défini'}}</h2>
                    <h2>Votre prénom : {{ Auth::user()->particulier->prenomparticulier ? Auth::user()->particulier->prenomparticulier : 'Non défini'}}</h2>
                    <?php

                        // $nomDB = Config::get('database.connections.pgsql.database');
                        // $userDB = Config::get('database.connections.pgsql.username');
                        // $motDePasse = Config::get('database.connections.pgsql.password');


                        // pg_connect("host=localhost dbname=$nomDB user=$userDB password=$motDePasse");
                        // pg_query("set names 'UTF8'");
                        // pg_query("SET search_path TO leboncoin");

                        // $query = "SELECT civilite FROM particulier
                        // WHERE idcompte=idparticulier AND idparticulier=civilite";
                        // // $text = pg_query($query);
                        // // echo $text;
                        // if(($query) == "t")
                        // {
                        //     echo "Homme";
                        // }else{
                        //     echo "Femme";
                        // }
                    ?> 
                    <!-- <h2>Votre civilité : {{ Auth::user()->particulier->civilite ? Auth::user()->particulier->civilite : 'Non défini'}}</h2> -->
                        
                @else
                    <p>Les informations du particulier ne sont pas définies.</p>
                @endif
            </div>
        </div>
        <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">Déconnexion</button>
        </form>
        
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function () {
                // Au chargement de la page, affiche le label et cache l'input
                $('#email').hide();
            
                // Gestion du clic sur le bouton "Modifier"
                //----------------------------------------------------
                $('#modifierEmail').on('click', function () {
                    // Cache le label et affiche l'input
                    $('#valeurEmail').hide();
                    $('#email').show().val($('#valeurEmail').text()).focus();
                });
            
                // Gestion du changement de focus sur l'input
                $('#email').on('blur', function () {
                    // Cache l'input et affiche le label
                    $('#valeurEmail').show().text($(this).val());
                    $(this).hide();
                });
            });
        </script>


<div id="container">
    <label for="champ">Nom :</label>
    <span id="valeurChamp">John Doe</span>
    <input type="text" id="champ" style="display: none;">
    <button id="modifierChamp">Modifier</button>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Au chargement de la page, affiche le label et cache l'input
        $('#champ').hide();

        // Gestion du clic sur le bouton "Modifier"
        $('#modifierChamp').on('click', function () {
            // Cache le label et affiche l'input
            $('#valeurChamp').hide();
            $('#champ').show().val($('#valeurChamp').text()).focus();
        });

        // Gestion du changement de focus sur l'input
        $('#champ').on('blur', function () {
            // Cache l'input et affiche le label
            $('#valeurChamp').show().text($(this).val());
            $(this).hide();
        });
    });
</script>


    @else
        <p>Vous n'êtes pas connecté.</p>
    @endauth
    
@endsection



