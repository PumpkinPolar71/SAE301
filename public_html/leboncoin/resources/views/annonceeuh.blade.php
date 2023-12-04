


@extends('layouts.app')

@section('content')


@if(Auth::check()) <!-- Vérifie si l'utilisateur est connecté -->
    <form method="post" action="{{ url("/annonce/save") }}">
        @csrf <!-- Ajoute un token CSRF pour la sécurité -->

        <!-- Champs pour le formulaire de création d'annonce -->
        <div>
        <label>Condition hébergement</label><br>
            <input type="DatePicker" name="apagnyan1" id="idconditionh">
            <label for="apagnyan1">Date arrivé</label><br>
            <input type="DatePicker" name="apagnyan1" id="idconditionh">
            <label for="apagnyan1">Date départ</label><br>
            <input type="checkbox" name="apagnyan" id="idconditionh">
            <label for="apagnyan">fumeur</label><br>
            <label for="apagnyan">animaux accéptés ?</label><br>
            </select>
        </div>

        <!-- Liste déroulante pour la ville -->
        <div>
            <!-- Choisir une ville -->
    <label for="ville">Choisir une ville :</label>
    <select name="ville" id="ville">
        <option value="">Toutes les villes</option>
        @foreach($villes as $ville)
            <option value="{{ $ville->idville }}" {{ request()->get('ville') == $ville->idville ? 'selected' : '' }}>{{ $ville->nomville }}</option>
        @endforeach
    </select>
        </div>

        <!-- Cases à cocher pour les critères -->
        <div>
            <label>Critères :</label><br>
            <input type="checkbox" name="critere_1" id="critere_1">
            <label for="critere_1">Critère 1</label><br>
            <!-- Ajoute les autres cases à cocher pour les critères -->
        </div>

        <!-- Description de l'annonce -->
        <div>
            <label for="description">Description :</label><br>
            <textarea name="description" id="description" rows="4" cols="50"></textarea><br>
        </div>

        <!-- Date automatique -->
        <div>
            <label for="date">Date :</label><br>
            <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}">
        </div>

        <!-- Titre de l'annonce -->
        <div>
            <label for="titreannonce">Titre de l'annonce :</label><br>
            <input type="text" name="titreannonce" id="titreannonce">
        </div>

        <!-- Bouton pour soumettre le formulaire -->
        <button id="submitb" type="submit">Créer annonce</button>
    </form>
@else
    <p>Vous devez être connecté pour créer une annonce.</p>
@endif

<!-- Script JavaScript -->
<script>
    // Ton script JavaScript actuel
</script>

@endsection


