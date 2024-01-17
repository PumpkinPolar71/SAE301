@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')

@auth

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('addreservation', ['id' => $idannonce]) }}">


    @csrf
    
    <input type="hidden" name="idannonce" value="{{ $idannonce ?? '' }}" required>

    <label for="nbadulte">Nombre d'adultes:</label>
    <input type="number" name="nbadulte" required><br><br>
    

    <label for="nbenfant">Nombre d'enfants:</label>
    <input type="number" name="nbenfant" required><br><br>

    <label for="nbbebe">Nombre de bébés:</label>
    <input type="number" name="nbbebe" required><br><br>

    <label for="nbanimaux">Nombre d'animaux:</label>
    <input type="number" name="nbanimaux" required><br><br>

    <label for="prenom">Prénom:</label>
    <input type="text" name="prenom" value="{{ $prenom ?? '' }}" pattern="[A-Za-z]+" title="Veuillez entrer uniquement des lettres ou des tirets" required><br><br>

    <label for="nom">Nom:</label>
    <input type="text" name="nom" value="{{ $nom ?? '' }}" pattern="[A-Za-z]+" title="Veuillez entrer uniquement des lettres ou des tirets" required><br><br>
   


    <label for="tel">Numéro de téléphone:</label>
    <input type="text" name="tel" id="tel" value="{{ $numeroTelephone }}" maxlength="14" required><br><br>

    <label for="nbnuitee">Nombre de nuits:</label>
    <input type="number" name="nbnuitee" required>

    
    <input type="hidden" name="taxessejour" required><br><br>

    <label for="montantimmediatacompte" required>Montant immédiat à compte:</label>
    <input type="checkbox" name="montantimmediatacompte" id="montantimmediatacompte">

    <div id="montantImmediatField" style="display: none;">
        @php
            // Récupération du prix nommé libprix dans la table annonce
            $annonce = App\Models\Annonce::find($idannonce);
            $montantImmediat = $annonce->libprix ?? '';
        @endphp

        <label for="montantimmediat">Montant immédiat:</label>
        <input type="text" name="montantimmediat" value="{{ $montantImmediat }}" id="montantimmediat">
    </div>

    <label for="message">Message:</label>
    <textarea name="message"></textarea><br><br>

    <input type="hidden" name="datedebutr" value="{{ $datedebut }}">
<input type="hidden" name="datefinr" value="{{ $datefin }}">

<label for="dates">Choisissez une date:</label>
<select name="dates" id="dates">
    @foreach ($datesDisponibles as $dateDebut => $dateFin)
        <option value="{{ $dateDebut }}_{{ $dateFin }}">{{ $dateFin }} - {{ $dateDebut }}</option>
    @endforeach
</select><br>

    
    

    <button class="deconectionn" type="submit">Payer</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#montantimmediatacompte').change(function() {
            if ($(this).is(':checked')) {
                $('#montantImmediatField').show();
            } else {
                $('#montantImmediatField').hide();
            }
        });
    });   
    

</script>

@else
<p>Vous devez être connecté.</p>
@endauth
@endsection