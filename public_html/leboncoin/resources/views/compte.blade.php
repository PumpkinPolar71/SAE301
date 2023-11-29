@extends('layouts.app')

@section('content')
    @auth
        <div class="bandeau">
            <div class="pdp"><p class="pDeMrd">Q</p></div><br>
            <div id="container">
                <h1></h1><br>
                <label for="email">Votre email : </label>
                <span class="valeuremail">{{ Auth::user()->compte ? Auth::user()->compte->email : 'Non défini' }}</span>
                <input type="text" id="email" style="display: none;">
                <button id="modifieremail">Modifier</button>
            </div>
            <div id="container">
                <h1></h1><br>
                <label for="adresse">Votre Adresse : </label>
                <span class="valeuradresse">{{ Auth::user()->compte ? Auth::user()->compte->adresseruecompte : 'Non défini' }}, {{ Auth::user()->compte ? Auth::user()->compte->adressecpcompte : 'Non défini' }}, {{ Auth::user()->ville ? Auth::user()->ville->nomville : 'Non défini' }}</span>
                <input type="text" id="adresse" style="display: none;">
                <button id="modifieradresse">Modifier</button>
            </div>
            <div id="container">
                <h1></h1><br>
                <label for="nom">Votre nom : </label>
                <span class="valeurnom">{{ Auth::user()->particulier->nomparticulier ? Auth::user()->particulier->nomparticulier : 'Non défini'}}</span>
                <input type="text" id="nom" style="display: none;">
                <button id="modifiernom">Modifier</button>
            </div>
            <div id="container">
                <h1></h1><br>
                <label for="prenom">Votre prénom : </label>
                <span class="valeurprenom">{{ Auth::user()->particulier->prenomparticulier ? Auth::user()->particulier->prenomparticulier : 'Non défini'}}</span>
                <input type="text" id="prenom" style="display: none;">
                <button id="modifierprenom">Modifier</button>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script>
                $(document).ready(function () {
                    // Au chargement de la page, affiche le label et cache l'input
                    $('#email').hide();
                    $('#adresse').hide();
                    $('#nom').hide();
                    $('#prenom').hide();
                
                    // Gestion du clic sur le bouton "Modifier"
                    //----------------------------------------------Email
                    $('#modifieremail').on('click', function () {
                        // Cache le label et affiche l'input
                        $('.valeuremail').hide();
                        $('#email').show().val($('.valeuremail').text()).focus();
                    });
                    //----------------------------------------------Adresse
                    $('#modifieradresse').on('click', function () {
                        // Cache le label et affiche l'input
                        $('.valeuradresse').hide();
                        $('#adresse').show().val($('.valeuradresse').text()).focus();
                    });
                    //----------------------------------------------Nom
                    $('#modifiernom').on('click', function () {
                        // Cache le label et affiche l'input
                        $('.valeurnom').hide();
                        $('#nom').show().val($('.valeurnom').text()).focus();
                    });
                    //----------------------------------------------Prenom
                    $('#modifierprenom').on('click', function () {
                        // Cache le label et affiche l'input
                        $('.valeurprenom').hide();
                        $('#prenom').show().val($('.valeurprenom').text()).focus();
                    });
                
                    // Gestion du changement de focus sur l'input
                    //----------------------------------------------Email
                    $('#email').on('blur', function () {
                        // Cache l'input et affiche le label
                        $('.valeuremail').show().text($(this).val());
                        $(this).hide();
                    });
                    //----------------------------------------------Adresse
                    $('#adresse').on('blur', function () {
                        // Cache l'input et affiche le label
                        $('.valeuradresse').show().text($(this).val());
                        $(this).hide();
                    });
                    //----------------------------------------------Nom
                    $('#nom').on('blur', function () {
                        // Cache l'input et affiche le label
                        $('.valeurnom').show().text($(this).val());
                        $(this).hide();
                    });
                    //----------------------------------------------Prenom
                    $('#prenom').on('blur', function () {
                        // Cache l'input et affiche le label
                        $('.valeurprenom').show().text($(this).val());
                        $(this).hide();
                    });
                });
            </script>
            <button id="saveChanges">Enregistrer les modifications</button>

<!-- Le script jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#saveChanges').on('click', function () {
            var newEmail = $('.valeuremail').val();
            var newAddress = $('.valeuradresse').text(); // Récupère la valeur de l'adresse

            // Requête AJAX pour envoyer les données modifiées au serveur
            $.ajax({
                url: '{{ route("updateUserInfo") }}',
                type: 'POST',
                data: {
                    email: newEmail,
                    address: newAddress,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    // Traitez la réponse du serveur (facultatif)
                    console.log(response);
                    // Vous pouvez également mettre à jour la vue après la réussite de la sauvegarde
                },
                error: function (error) {
                    // Gérez les erreurs en cas d'échec de la requête AJAX
                    console.log(error);
                }
            });
        });
    });
</script>

            <?php
                // $nomDB = Config::get('database.connections.pgsql.database');
                // $userDB = Config::get('database.connections.pgsql.username');
                // $motDePasse = Config::get('database.connections.pgsql.password');
                // pg_connect("host=localhost dbname=$nomDB user=$userDB password=$motDePasse");
                // pg_query("set names 'UTF8'");
                // pg_query("SET search_path TO leboncoin");
                
                

                // $queryEmail = "UPDATE Compte
                // SET email = 'Alfred Schmidt'
                // WHERE idcompte = Auth::user()->compte ? Auth::user()->compte->email : 'Non défini'";


            ?>
        </div>
        <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">Déconnexion</button>
        </form>
        
        
        </script>






    @else
        <p>Vous n'êtes pas connecté.</p>
    @endauth
    
@endsection



