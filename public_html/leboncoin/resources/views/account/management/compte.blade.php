@extends('layouts.app')

@section('content')
{{ session()->get("success") }}
    @auth
        <div class="bandeau">
            <div class="pdpT"><p class="pPseudo"></p></div>
            
                    <form method="post" action="{{ route('updateUserInfo') }}">
                        @csrf
                            <img class="pdpContainer" src="{{ Auth::user()->compte ? Auth::user()->compte->pdp : 'Non défini' }}" /><br>
                        <label for="lien_pdp">Lien de la photo :</label><br>
                        <input type="text" name="lien_pdp" id="lien_pdp">
                        <button type="submit" id="submit">Soumettre</button>
            </form>
            <form method="POST" action="{{ route('updateUserInfo') }}">
                @csrf
                <div id="container">
                    <h1></h1><br>
                    <label for="email">Votre email : </label>
                    <span class="valeuremail">{{ Auth::user()->compte ? Auth::user()->compte->email : 'Non défini' }}</span>
                    <input type="text" name="nouvelEmail" id="email" style="display: none;">
                    <div style="color:red;" id="messageErreurEmail"></div>
                    <button type="button" id="modifieremail">Modifier</button>
                    <button type="submit" id="submit">Envoyer</button>
                </div>
            </form>
            <form method="POST" action="{{ route('updateUserInfo') }}">
                @csrf
                <div id="container">
                    <h1></h1><br>
                    <label for="adresserue">Votre adresse rue : </label>
                    <span class="valeuradresserue">{{ Auth::user()->compte ? Auth::user()->compte->adresseruecompte : 'Non défini' }}</span>
                    <input type="text" id="adresserue" name="nouvelleRue" style="display: none;">
                    <button type="button" id="modifieradresserue">Modifier</button>
                    <button type="submit" id="submit">Envoyer</button>
                </div>
            </form>
            <form method="POST" action="{{ route('updateUserInfo') }}">
                @csrf
                <div id="container">
                    <h1></h1><br>
                    <label for="adressecp">Votre adresse code postal : </label>
                    <span class="valeuradressecp">{{ Auth::user()->compte ? Auth::user()->compte->adressecpcompte : 'Non défini' }}</span>
                    <input type="text" id="adressecp" name="nouveauCP" style="display: none;">
                    <button type="button" id="modifieradressecp">Modifier</button>
                    <button type="submit" id="submit">Envoyer</button>
                </div>
            </form>
            <form method="POST" action="{{ route('updateUserInfo') }}">
                @csrf
                <div id="container">
                    <h1></h1><br>
                    <label for="adresseville">Votre ville : </label>
                    <span class="valeuradresseville">{{ Auth::user()->ville ? Auth::user()->ville->nomville : 'Non défini' }}</span>
                    <input type="text" id="adresseville" name="nouvelleVille" style="display: none;">
                    <button type="button" id="modifieradresseville">Modifier</button>
                    <button type="submit" id="submit">Envoyer</button>
                </div>
            </form> 
            <form method="POST" action="{{ route('updateUserInfo') }}">
                @csrf
                <div id="container">
                    <h1></h1><br>
                    <label for="nom">Votre nom : </label>
                    <span class="valeurnom">{{ Auth::user()->particulier->nomparticulier ? Auth::user()->particulier->nomparticulier : 'Non défini'}}</span>
                    <input type="text" id="nom" name="nouveauNom" style="display: none;">
                    <button type="button" id="modifiernom">Modifier</button>
                    <button type="submit" id="submit">Envoyer</button>
                </div>
            </form>
            <form method="POST" action="{{ route('updateUserInfo') }}">
                @csrf 
                <div id="container">
                    <h1></h1><br>
                    <label for="prenom">Votre prénom : </label>
                    <span class="valeurprenom">{{ Auth::user()->particulier->prenomparticulier ? Auth::user()->particulier->prenomparticulier : 'Non défini'}}</span>
                    <input type="text" id="prenom" name="nouveauPrenom" style="display: none;">
                    <button type="button" id="modifierprenom">Modifier</button>
                    <button type="submit" id="submit">Envoyer</button>
                </div>
            </form>
            



            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script>
                $(document).ready(function () {
                    // Au chargement de la page, affiche le label et cache l'input
                    // $('#image').hide();
                    $('#email').hide();
                    $('#adresserue').hide();
                    $('#adressecp').hide();
                    $('#adresseville').hide();
                    $('#nom').hide();
                    $('#prenom').hide();

                    // Gestion du clic sur le bouton "Modifier"
                    //----------------------------------------------Pdp
                    $('#modifierpdp').on('click', function () {
                        // Cache le label et affiche l'input
                        $('.valeurpdp').hide();
                        $('#pdp').show().val($('.valeurpdp').text()).focus();
                    });
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
                        $('#adresserue').show().val($('.valeuradresserue').text()).focus();
                    });
                    $('#modifieradressecp').on('click', function () {
                        // Cache le label et affiche l'input
                        $('.valeuradressecp').hide();
                        $('#adressecp').show().val($('.valeuradressecp').text()).focus();
                    });
                    $('#modifieradresseville').on('click', function () {
                        // Cache le label et affiche l'input
                        $('.valeuradresseville').hide();
                        $('#adresseville').show().val($('.valeuradresseville').text()).focus();
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
                    //----------------------------------------------Pdp
                    $('#pdp').on('blur', function () {
                        // Cache l'input et affiche le label
                        $('.valeurpdp').show().text($(this).val());
                        $(this).hide();
                    });
                    //----------------------------------------------Email
                    $('#email').on('blur', function () {
                        // Cache l'input et affiche le label
                        $('.valeuremail').show().text($(this).val());
                        $(this).hide();
                        //code erreur quand non-respect des champs
                        console.log("test blur")
                        var Reg = new RegExp(/^[^\s@]+@[^\s@]+\.[^\s@]+$/);        
                        const email = document.getElementById("email").value;
                        const messageErreur = document.getElementById("messageErreurEmail");
                        if (!Reg.test(email))   {
                            messageErreur.textContent = "L'adresse email n'est pas valide.";
                            btenvoi.hide()
                        } else {
                            messageErreur.textContent = "";
                            btenvoi.show()
                        }
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
            
            
        </div>
        <a href="/annoncelist/{{Auth::user()->compte ? Auth::user()->compte->idcompte : 'Non défini'}}">
            <div class="compte-block"><b>Annonce</b>
                <p>Gérer mes annonces déposées</p>
            </div>
        </a>
        <a href="/reservationlist/{{Auth::user()->compte ? Auth::user()->compte->idcompte : 'Non défini'}}">
            <div class="compte-block"><b>Réservation</b>
                <p>Retrouver vos réservations</p>
            </div>
        </a>
        <a href="/mes-incidents">
            <div class="compte-block"><b>Incident</b>
                <p>Répondre aux incidents sur les annonces réservées</p>
            </div>
        </a>
        <a href="/mes-infos-bancaires">
            <div class="compte-block"><b>Carte bancaire</b>
                <p>Gérer vos informations bancaires</p>
                
            </div>
        </a>
        <a href="/mesinfoperso">
            <div class="compte-block"><b>Mes informations personelles</b>
                <p>Gérer et voir vos informations personelles</p>
                
            </div>
        </a>
        @if (Auth::user()->compte->codeetatcompte == 14 )
        <a href="/createheb">
            <div class="compte-block"><b>Creer type hébergement et equipement</b>
                <p></p>
            </div>
        </a>
        @endif
        <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">Déconnexion</button>
        
        </form>
        
        
        </script>






    @else
        <p>Vous n'êtes pas connecté.</p>
    @endauth
    
@endsection



