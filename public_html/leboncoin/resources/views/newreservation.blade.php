@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('addreservation') }}">
    @csrf
    
    <input type="hidden" name="idannonce" value="{{ $idannonce ?? '' }}">

    <label for="nbadulte">Nombre d'adultes:</label>
    <input type="number" name="nbadulte"><br><br>
    

    <label for="nbenfant">Nombre d'enfants:</label>
    <input type="number" name="nbenfant"><br><br>

    <label for="nbbebe">Nombre de bébés:</label>
    <input type="number" name="nbbebe"><br><br>

    <label for="nbanimaux">Nombre d'animaux:</label>
    <input type="number" name="nbanimaux"><br><br>

    <label for="prenom">Prénom:</label>
<input type="text" name="prenom" value="{{ $user->prenom ?? '' }}"><br><br>

<label for="nom">Nom:</label>
<input type="text" name="nom" value="{{ $user->nom ?? '' }}"><br><br>

<label for="tel">Numéro de téléphone:</label>
<input type="text" name="tel" id="tel" value="{{ $numeroTelephone }}"><br><br>

    <label for="nbnuitee">Nombre de nuits:</label>
    <input type="number" name="nbnuitee"><br><br>

    <label for="taxessejour">Taxe de séjour:</label>
    <input type="text" name="taxessejour"><br><br>

    <label for="montantimmediatacompte">Montant immédiat à compte:</label>
    <input type="text" name="montantimmediatacompte"><br><br>

    <label for="montantimmediat">Montant immédiat:</label>
    <input type="text" name="montantimmediat"><br><br>

    <label for="message">Message:</label>
    <textarea name="message"></textarea><br><br>

    <label for="datedebutr">Date de début:</label>
    <input type="date" name="datedebutr"><br><br>

    <label for="datefin">Date de fin:</label>
    <input type="date" name="datefin"><br><br>

    <button type="submit">Soumettre</button>
</form>
@endsection