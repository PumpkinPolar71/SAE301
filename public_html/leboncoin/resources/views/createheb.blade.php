@extends('layouts.app')

@section('content')

{{ session()->get("error") }}
    <div class="allcreateheb">
        <div class="hebergement">
            <h2>Types hebergements</h2>
            <div>Liste :</div>
            <?php
                foreach($typehebergements as $typehebergment){
                    echo "<p>".$typehebergment->type."</p>";
                }
            ?>
            <div>Ajouter :</div>
            <form action="{{ route('ajoutheb') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nomhebergement">Nom du type d'hébergement</label>
                    <input type="text" name="nomhebergement" id="nomhebergement" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Créer le type d'hebergement</button>
            </form>
        </div>
        <div class="equipement">
            <h2>Equipements</h2>
            <div>Liste :</div>
            <?php
                foreach($equipements as $equipement){
                    echo "<p>".$equipement->nomequipement."</p>";
                }
            ?>
               <div>Ajouter :</div>
            <form action="{{ route('ajoutequ') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nomequipement">Nom de l'équipement</label>
                    <input type="text" name="nomequipement" id="nomequipement" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Créer l'équipement</button>
            </form>
        </div>

    </div>
@endsection
