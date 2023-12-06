@extends('layouts.app')

@section('content')
    @auth
        <div class="bandeau">
            <div class="pdp"><p class="pPseudo"></p></div><br> 
            
            <form method="POST" action="{{ route('updateUserInfo') }}">
                @csrf
                    <div id="container">
                        <h1></h1><br>
                        <label for="pdp">Votre photo de profil : </label>
                        <span class="valeurpdp">{{ Auth::user()->compte ? Auth::user()->compte->pdp : 'Non défini' }}</span>
                        <input class="valeurpdp" type="text" name="nouvellePdp" id="pdp" style="display: none;">
                        
                        <button type="button" id="modifierpdp">Modifier</button>
                    </div>
                <div class="popupop">
                <h2>Glisser deposer</h2>
                    <style>
                        #drop-zone {
                            border: 2px dashed #ccc;
                            padding: 20px;
                            text-align: center;
                        }
                        #image-container {
                            margin-top: 20px;
                        }
                    </style>
                </head>
                <body>
                    <div id="drop-zone">
                        <p>Faites glisser et déposez des images PNG ou JPG ici.</p>
                    </div>
                    <form id="formImgC" method="post">
                        <div id="image-container"></div>
                        <div id="valeurpdp"></div>
                        <!-- <div class="valeurpdp"></div> -->
                    </form>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var dropZone = document.getElementById('drop-zone');
                            var imageContainer = document.getElementById('image-container');
                            // var imageUrlContainer = document.getElementById('valeurpdp');
                            let valeurpdp = document.querySelector('.valeurpdp')

                            // Empêcher le comportement par défaut pour éviter le chargement du fichier dans le navigateur
                            dropZone.addEventListener('dragover', function (e) {
                                e.preventDefault();
                            });
                        
                            // Gérer l'événement de glisser
                            dropZone.addEventListener('drop', function (e) {
                                e.preventDefault();
                            
                                var files = e.dataTransfer.files;

                                for (var i = 0; i < files.length; i++) {
                                    var file = files[i];
                                    console.log(file.name);
                                    // Vérifier si le fichier est une image PNG ou JPG
                                    if (file.type === 'image/png' || file.type === 'image/jpeg') {
                                        // Créer un élément image et l'ajouter à la page
                                        var imgElement = document.createElement('img');
                                        imgElement.src = URL.createObjectURL(file);
                                        imgElement.alt = 'Image';
                                        console.log(imgElement.src);
                                        imageContainer.appendChild(imgElement);
                                        // imageUrlContainer.appendChild(imgElement.src);
                                        imageUrlContainer = URL.createObjectURL(file);
                                        console.log(imageUrlContainer);
                                        valeurpdp.innerHTML = imageUrlContainer;    
                                        console.log(valeurpdp.innerHTML);

                                    }
                                }
                            
                            });
                        });
                    </script>
                    

                    <button type="submit" id="submit">Envoyer</button>
                </div>
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
                    //var popupop = $(".popupop")
                    var i=0;
                    let btenvoi = $("#submit")
                    // Au chargement de la page, affiche le label et cache l'input
                    $('#pdp').hide();
                    $('#email').hide();
                    $('#adresserue').hide();
                    $('#adressecp').hide();
                    $('#adresseville').hide();
                    $('#nom').hide();
                    $('#prenom').hide();

                    $('.popupop').hide();
                    $('.popupop').on('click', function () {
                        i++
                        if (i%2 != 0) {
                            $('.popupop').css("display" , "none");
                        } else {
                            $('.popupop').css("display" , "block");
                        }
                    })
                    $('#modifierpdp').on('click', function () {
                        i++
                        if (i%2 == 0) {
                            $('.popupop').css("display" , "none");
                        } else {
                            $('.popupop').css("display" , "block");
                        }
                    })
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
        <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">Déconnexion</button>
        </form>
        
        
        </script>






    @else
        <p>Vous n'êtes pas connecté.</p>
    @endauth
    
@endsection



