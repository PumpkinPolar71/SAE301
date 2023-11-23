
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
    <div>date naissance JJ-MM-AAAA</div>
    <input name="date" type="">
    <div>Ville</div>
    <input name="ville" type="">
    <div>Addresse</div>
    <input name="rue" type="">
    <div>Code Postal</div>
    <input name="cp" type="">
    <div>Mot de passe</div>
    <input name="mdp" type="password">
    <div>Recevoir des mails commerciaux </div><input name="mail" type="checkbox">
    <button type="submit">Créer mon compte</button>
</form>