<link rel="stylesheet" type="text/css" href="{{asset('create.css')}}"/> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Flèche de retour à la page précédente -->
<div class="flecheretour" onclick="history.back()">←</div>

<!-- Titre du formulaire avec lien vers la page d'accueil -->
<div class="titleconnect"><a href="{{ url("/") }}"><b>LeBonCoin</b></a></div>

<!-- Formulaire de création de compte -->
<form method="post" action="{{ url("/saveaccount") }}" onsubmit="return verifierSexe()">
    @csrf <!-- Protection contre les attaques CSRF -->

    <div>Les champs avec un * sont obligatoires</div>

    <!-- Champ pour le nom -->
    <div>Nom *</div>
    <input name="nom" type="" value="{{ old('nom') }}" required>

    <!-- Champ pour le prénom -->
    <div>Prenom *</div>
    <input name="prenom" type="" value="{{ old('prenom') }}" required>

    <!-- Champ pour l'email -->
    <div>Email *</div>
    <input id="email" name="email" type="" required>
    <div style="color:red;" id="messageErreurEmail"></div>
    <div style="color: red;">{{ session('errorEmailExist') }}</div>

    <!-- Sélection du sexe de naissance -->
    <div>Sexe de naissance *</div>
    <input type="radio" value="Homme" name="sexe" id="homme" {{ old('sexe') == 'Homme' ? 'checked' : '' }}>
    <label for="homme">Homme</label>
    <input type="radio" value="Femme" name="sexe" id="femme" {{ old('sexe') == 'Femme' ? 'checked' : '' }}>
    <label for="femme">Femme</label>

    <!-- Champ pour la date de naissance -->
    <div>date naissance (JJ-MM-AAAA) *</div>
    <input id="date" name="date" type="" value="{{ old('date') }}" required>
    <div style="color:red;" id="messageErreurDate"></div>

    <!-- Champ pour l'adresse (géographique) -->
    <div>Adresse *</div>
    <input name="adresse" type="" id="adresse" value="{{ old('adresse') }}" required>
    <div style="" id="listA"></div>

    <!-- Champ pour le code postal -->
    <div>Code Postal *</div>
    <input id="cp" name="cp" readOnly="readOnly" value="{{ old('cp') }}" required>
    <div style="display:none; color:#f55;" id="error-message"></div>

    <!-- Champ pour la ville -->
    <div>Ville *</div>
    <input id="ville" name="ville" readOnly="readOnly" value="{{ old('ville') }}" required>
    <input style="display:none;" id="region" name="region" readOnly="readOnly" value="{{ old('region') }}">
    <input style="display:none;" id="dept" name="dept" readOnly="readOnly" value="{{ old('dept') }}">

    <!-- Champ pour le mot de passe -->
    <div>Mot de passe *</div>
    <input name="mdp" id="mdp" type="password" required>
    <div id="messageErreur">Le mot de passe doit comporter au moins 12 caractères comprenant au moins une majuscule, une minuscule, un chiffre et un caractère spécial.</div>

    <!-- Case à cocher pour recevoir des mails commerciaux -->
    <input name="mail" type="checkbox" {{ old('mail') ? 'checked' : '' }}><div id="mail" >Recevoir des mails commerciaux </div>
    
    <button id="submitb" type="submit">Créer mon compte</button>


    <script>
        // Fonction pour vérifier si l'un des boutons radio "Homme" ou "Femme" est coché
        function verifierSexe() {
            var hommeChecked = document.getElementById("homme").checked;
            var femmeChecked = document.getElementById("femme").checked;
        
            if (!hommeChecked && !femmeChecked) {
                alert("Veuillez sélectionner le sexe de naissance.");
                return false;
            } else {
                return true;
            }
        }

        // Fonction pour récupérer les informations d'une iddiv lors d'un clic
        function recupererIdDiv(id) {
            console.log("L'ID de la div est : " + document.getElementById(id));
            all = document.getElementById(id).innerHTML.split(",");
            console.log(all);
            document.getElementById("adresse").value = all[0];
            document.getElementById("ville").value = all[1];
            document.getElementById("cp").value = all[2];
            document.getElementById("dept").value = all[4];
            document.getElementById("region").value = all[5];
        }
        
        $(document).ready(function() {
            let btenvoi = $("#submitb")

            // Gestionnaire d'événement pour la validation de la date lors de la saisie
            $("#date").on("keyup", function () {
                var regDate = /^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-\d{4}$/;
                const date = $("#date").val();
                const messageErreurDate = $("#messageErreurDate");
                alldate = $("#date").val().split("-");
                if (alldate[0] < 1 || alldate[0] > 31 || alldate[1] < 1 || alldate[1] > 12 || alldate[2] < 1900 || alldate[2] > 2013) {
                    messageErreurDate.text("La date de naissance n'est pas valide.");
                    btenvoi.hide();
                } else if(!regDate.test(date)) {
                    messageErreurDate.text("Le format saisie n'est pas valide.");
                    btenvoi.hide();
                }
                else {
                    messageErreurDate.text("");
                    btenvoi.show();
                }
            });
            // Gestionnaire d'événement pour la validation de l'adresse email lors de la saisie
            $("#email").on("blur", function () {
                var Reg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                const email = $("#email").val();
                const messageErreur = $("#messageErreurEmail");
                if (!Reg.test(email)) {
                    messageErreur.text("L'adresse email n'est pas valide.");
                    btenvoi.hide();
                } else {
                    messageErreur.text("");
                    btenvoi.show();
                }
            });

            // Gestionnaire d'événement pour la validation du mot de passe lors de la saisie
            $("#mdp").on("keyup", function () {
               var Reg = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{12,}$/;
               const motDePasse = $("#mdp").val();
               if (!Reg.test(motDePasse)) {
                   $("#messageErreur").css("color", "red");
                   btenvoi.hide();
               } else {
                   $("#messageErreur").css("color", "black");
                   btenvoi.show();
               }
            });

            // Configuration des URL pour les requêtes d'API
            const apiUrl = 'https://geo.api.gouv.fr/communes?codePostal=';
            const format = '&format=json';
            const apiUrlAdresse = "https://api-adresse.data.gouv.fr/search/?q=";
            const limit = "&limit=12";
                
            let html = $("html");
            let adresse = $("#adresse");
            let listA = $("#listA");
            let errorMessage = $("#error-message");

            // Gestionnaire d'événement pour la recherche d'adresses lors de la saisie
            $(adresse).on('keyup', function () {
                let codeA = $(this).val();
                let urlA = apiUrlAdresse + codeA + limit;
                if (codeA.length < 3) {} else {
                    for (lettre in codeA) {
                        urlA = urlA.replace(' ', '%20');
                    }
                    fetch(urlA, { method: 'get' }).then(response => response.json()).then(results => {
                        $(listA).find('div').remove();
                        $(listA).find('br').remove();
                        if (results.features[0].properties.label != "") {
                            $("#listA").css("display", "block");
                            $(errorMessage).text('').hide();
                            var i = 0;
                            $.each(results.features, function (key, value) {
                                $(listA).append('<div class="apiAdr" id="apiAdr' + i + '" onclick="recupererIdDiv(this.id)">' + results.features[i].properties.name + ',' + results.features[i].properties.city + ',' + results.features[i].properties.postcode + ',' + results.features[i].properties.context + '</div>');
                                i++;
                            });
                        } else {
                            if ($(adresse).val()) {
                                $(errorMessage).text('Aucune rue avec ce nom.').show();
                            } else {
                                $(errorMessage).text('').hide();
                            }
                        }
                    }).catch(err => {
                        console.log(err);
                        $(listA).find('option').remove();
                    });
                }
            });
        
            // Gestionnaire d'événement pour masquer la liste d'adresses lors du clic en dehors
            $(html).on('click', function () {
                $("#listA").css("display", "none");
            });
        });
        
        var botmanWidget = {
            aboutText: '',
            introMessage: "Bienvenue dans notre site web",
            title: "Chatbot",
            mainColor: '#ff6e14',
            bubbleBackground: '#EC5A13',
            bubbleAvatarUrl: ''
        };
        
    
    </script>
</form>