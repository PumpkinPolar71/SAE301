@extends('layouts.app')

@section('content')


@if(Auth::check()) <!-- Vérifie si l'utilisateur est connecté -->
    <form  method="post" action="{{ url("/annonce/ajouterAnnonce") }}">
        @csrf <!-- Ajoute un token CSRF pour la sécurité -->
        <!-- Titre de l'annonce -->
        <div>
            <label class=ajoutAnnonce for="titreannonce">Titre de l'annonce :</label><br>
            <input class=ajoutAnnonce type="text" name="titreannonce" id="titreannonce">
        </div>
        <!-- Champs pour le formulaire de création d'annonce -->
        <div>
        <h3><label>Condition hébergement</label><br></h3>
            <label for="datearrive">Heure d'arrivée :</label><br>
            <input class=ajoutAnnonce type="time" name="datearrive" id="idconditionh" value="{{ date('Y-m-d') }}"><br>
            <label for="datedepart">Heure de départ :</label><br>
            <input class=ajoutAnnonce type="time" name="datedepart" id="idconditionh" value="{{ date('Y-m-d') }}"><br>
            <label for="fumeur">fumeur</label><br>
            <input class=ajoutAnnonce type="checkbox" name="fumeur" id="idconditionh"><br>
            <label for="animaux">animaux accéptés ?</label><br>
            <input class=ajoutAnnonce type="checkbox" name="animaux" id="idconditionh"><br>
            
            </select>
        </div>

        <!-- Liste déroulante pour la ville -->
        <div>
            <!-- Choisir une ville -->
    <label for="ville">Choisir une ville :</label>
    <select class=ajoutAnnonce name="ville" id="ville">
        <option value="">Toutes les villes</option>
        @foreach($villes as $ville)
            <option value="{{ $ville->idville }}" {{ request()->get('ville') == $ville->idville ? 'selected' : '' }}>{{ $ville->nomville }}</option>
        @endforeach
    </select>
        </div>
    <!-- Choisir un type d'hébergement -->
    <label for="ville">Choisir un type d'hébergement :</label>
    <select class=ajoutAnnonce name="type_hebergement" id="type_hebergement">
        <option value="">Tous les types</option>
        @foreach($typesHebergements as $type)
            <option value="{{ $type->idtype }}">{{ $type->type }}</option>
        @endforeach
    </select>
        <!-- Cases à cocher pour les critères -->
        <div>
            <label>Capacité(nombres de personnes pouvant etre accueillies) :</label><br>
            <input class=ajoutAnnonce type="textbox" name="critere1" id="idcritere"><br>
            <label>Nombres de chambres :</label><br>
            <input class=ajoutAnnonce type="textbox" name="critere2" id="idcritere"><br>
            
            <!-- Ajoute les autres cases à cocher pour les critères -->
        </div>

        <!-- Description de l'annonce -->
        <div>
            <label for="description">Description :</label><br>
            <textarea class=ajoutAnnonce name="description" id="description" rows="4" cols="50"></textarea><br>
        </div>

        <!-- Date automatique -->
        <!-- automatique dans la base de données (current_date) -->
    @csrf
    <label for="prix">Prix :</label>
    <input class=ajoutAnnonce type="number" step="10" name="prix" id="prix" required>
    <button type="submit">Soumettre</button>
<!-- </form><br> -->



@if ($errors->has('prix'))
    <span class="error">{{ $errors->first('prix') }}</span>
@endif
@if ($errors->has('critere1'))
    <span class="error">{{ $errors->first('critere1') }}</span>
@endif

@if ($errors->has('critere2'))
    <span class="error">{{ $errors->first('critere2') }}</span>
@endif        
<div>
    <label for="lien_photo">Lien de la photo :</label><br>
    <input class=ajoutAnnonce type="text" name="lien_photo" id="lien_photo">
</div>

<!-- Date de début date de fin des disponibilités -->
    <label for="datedebut">Date de début de disponibilité :</label><br>
    <input class=ajoutAnnonce type="date" name="datedebut" id="idconditionh" value="{{ date('Y-m-d') }}"><br>
    <label for="datefin">Date de fin de disponibilité :</label><br>
    <input class=ajoutAnnonce type="date" name="datefin" id="idconditionh" value="{{ date('Y-m-d') }}"><br>

    <input style="display: none;" class=ajoutAnnonce type="date" name="date" id="idconditionh" value="{{ date('Y-m-d') }}"><br>
        <!-- Bouton pour soumettre le formulaire -->
        <button id="submitb" type="submit">Créer annonce</button>
    </form>
@else
    <p>Vous devez être connecté pour créer une annonce.</p>
@endif

<!-- Script JavaScript -->
<script>
    
</script>

@endsection


