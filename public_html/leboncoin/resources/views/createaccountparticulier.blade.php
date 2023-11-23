<link rel="stylesheet" type="text/css" href="{{asset('style2.css')}}"/> 
<form method="post" action="{{ url("/annonce/save") }}">
@csrf
  {{ session()->get("error") }}
    <div>Nom</div>
    <input name="nom" type="">
    <div>Prenom</div>
    <input name="prenom" type="">
    <div>Email</div>
    <input name="email" type="">
    <div>civilité</div>
    <input type="radio" id="homme" name="sexe">
        <label for="homme">Homme</label>
        <input type="radio" id="femme" name="sexe">
        <label for="femme">Femme</label>
        <input type="radio" id="nonDefini" name="sexe">
        <label for="nonDefini">Non défini</label>
    <div>date naissance (JJ-MM-AAAA)</div>
    <input name="date" type="">
    <div>Ville</div>
    <input name="ville" type="">
    <div>Addresse</div>
    <input name="rue" type=""id="adresseInput>
    <div>Code Postal</div>
    <input name="cp" type="">
    <div>Mot de passe</div>
    <input name="mdp" type="password">
    <div>Recevoir des mails commerciaux </div><input name="mail" type="checkbox">
    
    <script>
        document.getElementById('userForm').addEventListener('submit', function(e) {
            e.preventDefault();

            var dateInput = document.getElementsByName('date')[0].value;
            var dateFrArray = dateInput.split('-');
            var dateEn = dateFrArray[2] + '-' + dateFrArray[1] + '-' + dateFrArray[0];

            document.getElementsByName('date')[0].value = dateEn;
            this.submit();
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=VOTRE_CLE_API&libraries=places"></script>
    <script>
    function initAutocomplete() {
        var autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('adresseInput'),
            { types: ['geocode'] }
        );

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            // Vous pouvez utiliser les données de 'place' pour obtenir des informations sur l'adresse sélectionnée
        });
    }

    google.maps.event.addDomListener(window, 'load', initAutocomplete);
</script>

    <button type="submit">Créer mon compte</button>
</form>