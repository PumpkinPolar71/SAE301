@extends('layouts.app')

@section('content')

{{ session()->get("error") }}

@auth
    @if (Auth::user()->compte->codeetatcompte == 14 )
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
                    <input type="text" name="nomhebergement" id="nomhebergement" class="form-control" value="{{ old('nomhebergement') }}" required>
                    <div style="color: red;">{{ session('errorTypeHebExist') }}</div>
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
                    <input type="text" name="nomequipement" id="nomequipement" class="form-control" value="{{ old('nomequipement') }}" required>
                    <div style="color: red;">{{ session('errorEquipementExist') }}</div>
                </div>
                <button type="submit" class="btn btn-primary">Créer l'équipement</button>
            </form>
        </div>

    </div>
    @else
    <p>Vous n'avez pas les autorisation de visualiser cette page, cette incident à été signalé.</p>
    @endif
@else
<p>Vous n'avez pas les autorisation de visualiser cette page, cette incident à été signalé.</p>
@endauth
@endsection
