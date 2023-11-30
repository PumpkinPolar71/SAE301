@extends('layouts.app')

@section('content')
    @auth
        <div class="bandeau">
            <div class="pdp"><p class="pDeMrd"></p></div><br>
            <form method="POST" action="{{ route('updateUserInfo') }}">
                @csrf
                <div id="container">
                    <h1></h1><br>
                    <label for="email">Votre email : </label>
                    <span class="valeuremail">{{ Auth::user()->compte ? Auth::user()->compte->email : 'Non défini' }}</span>
                    <input type="text" name="nouvelEmail" id="email" style="display: none;">
                    <button type="button" id="modifieremail">Modifier</button>
                </div>
                <div id="container">
                    <h1></h1><br>
                    <label for="adresserue">Votre adresse rue : </label>
                    <span class="valeuradresserue">{{ Auth::user()->compte ? Auth::user()->compte->adresseruecompte : 'Non défini' }}</span>
                    <input type="text" id="adresserue" name="nouvelleRue" style="display: none;">
                    <button type="button" id="modifieradresserue">Modifier</button>
                </div>
                <div id="container">
                    <h1></h1><br>
                    <label for="adressecp">Votre adresse code postal : </label>
                    <span class="valeuradressecp">{{ Auth::user()->compte ? Auth::user()->compte->adressecpcompte : 'Non défini' }}</span>
                    <input type="text" id="adressecp" name="nouveauCP" style="display: none;">
                    <button type="button" id="modifieradressecp">Modifier</button>
                </div>
                <div id="container">
                    <h1></h1><br>
                    <label for="adresseville">Votre ville : </label>
                    <span class="valeuradresseville">{{ Auth::user()->ville ? Auth::user()->ville->nomville : 'Non défini' }}</span>
                    <input type="text" id="adresseville" name="nouvelleVille" style="display: none;">
                    <button type="button" id="modifieradresseville">Modifier</button>
                </div>
                <div id="container">
                    <h1></h1><br>
                    <label for="nom">Votre nom : </label>
                    <span class="valeurnom">{{ Auth::user()->particulier->nomparticulier ? Auth::user()->particulier->nomparticulier : 'Non défini'}}</span>
                    <input type="text" id="nom" name="nouveauNom" style="display: none;">
                    <button type="button" id="modifiernom">Modifier</button>
                </div>
                <div id="container">
                    <h1></h1><br>
                    <label for="prenom">Votre prénom : </label>
                    <span class="valeurprenom">{{ Auth::user()->particulier->prenomparticulier ? Auth::user()->particulier->prenomparticulier : 'Non défini'}}</span>
                    <input type="text" id="prenom" name="nouveauPrenom" style="display: none;">
                    <button type="button" id="modifierprenom">Modifier</button>
                </div>
                <button type="submit">Envoyer</button>
                
            </form>
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
                    $('#modifieradresserue').on('click', function () {
                        // Cache le label et affiche l'input
                        $('.valeuradresserue').hide();
                        $('#adresse').show().val($('.valeuradresserue').text()).focus();
                    });
                    $('#modifieradressecp').on('click', function () {
                        // Cache le label et affiche l'input
                        $('.valeuradressecp').hide();
                        $('#adresse').show().val($('.valeuradressecp').text()).focus();
                    });
                    $('#modifieradresseville').on('click', function () {
                        // Cache le label et affiche l'input
                        $('.valeuradresseville').hide();
                        $('#adresse').show().val($('.valeuradresseville').text()).focus();
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
                    $('#adresserue').on('blur', function () {
                        // Cache l'input et affiche le label
                        $('.valeuradresserue').show().text($(this).val());
                        $(this).hide();
                    });
                    $('#adressecp').on('blur', function () {
                        // Cache l'input et affiche le label
                        $('.valeuradressecp').show().text($(this).val());
                        $(this).hide();
                    });
                    $('#adresseville').on('blur', function () {
                        // Cache l'input et affiche le label
                        $('.valeuradresseville').show().text($(this).val());
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
            <button type="submit" id="saveChanges">Enregistrer les modifications</button>

            
        </div>
        <a href="/annonce/{{Auth::user()->compte ? Auth::user()->compte->idcompte : 'Non défini'}}"><div class="compte-block"><b>Annonce</b>
                <p>Gérer mes annonces déposées</p>
        </div></a>
        <a href="/reservation/{{Auth::user()->compte ? Auth::user()->compte->idcompte : 'Non défini'}}"><div class="compte-block"><b>Réservation</b>
                <p>Retrouver vos réservations</p>
        </div></a>
        <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">Déconnexion</button>
        </form>
        
        
        </script>






    @else
        <p>Vous n'êtes pas connecté.</p>
    @endauth
    
@endsection



