
<form method="post" action="{{ url("/annonce/save") }}">
    <div>Nom</div>
    <input id="nom" type="">
    <div>Prenom</div>
    <input id="prenom" type="">
    <div>Email</div>
    <input id="email" type="">
    <div>civilité</div>
    <input type="radio" id="civi" name="civi" value="Homme" checked />
    <label for="Homme">Homme</label>
    <input type="radio" id="civi" name="civi" value="Femme" />
    <label for="Femme">Femme</label>
    <div>date naissance AAAA-MM-JJ</div>
    <input id="date" type="">

    <button type="submit">Créer mon compte</button>
</form>