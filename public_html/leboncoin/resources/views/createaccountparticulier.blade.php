
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
    <!--<input type="radio" id="civi" name="civi" value="Homme" checked />
    <label for="Homme">Homme</label>
    <input type="radio" id="civi" name="civi" value="Femme" />
    <label for="Femme">Femme</label>--> <input name="civi" type="">
    <div>date naissance AAAA-MM-JJ</div>
    <input name="date" type="">

    <button type="submit">Créer mon compte</button>
</form>