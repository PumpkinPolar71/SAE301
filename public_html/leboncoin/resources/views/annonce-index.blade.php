<form action="{{ route('annonce-index') }}" method="GET">
    <!-- Choisir une ville -->
    <label for="ville">Choisir une ville :</label>
    <select name="ville" id="ville">
        <option value="">Toutes les villes</option>
        @foreach($villes as $id => $ville)
            <option value="{{ $id }}">{{ $ville->nomville }}</option>
        @endforeach
    </select>
    
    <!-- Choisir un type d'hébergement -->
    <label for="type_hebergement">Choisir un type d'hébergement :</label>
    <select name="type_hebergement" id="type_hebergement">
        <option value="">Tous les types</option>
        @foreach($typesHebergement as $type)
            <option value="{{ $type->id }}">{{ $type->nom }}</option>
        @endforeach
    </select>
    
    <!-- Choisir une période de disponibilité -->
    <label for="datedebut">Date de début :</label>
    <input type="date" name="datedebut" id="datedebut">
    <label for="datefin">Date de fin :</label>
    <input type="date" name="datefin" id="datefin">
    
    <button type="submit">Rechercher</button>
</form>
