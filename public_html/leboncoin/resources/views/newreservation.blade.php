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

<form method="POST" action="{{ route('addreservation', ['idannonce' => $idAnnonce]) }}">
    @csrf

    <input type="hidden" name="idannonce" value="{{ $idAnnonce }}">

    <label for="idperiode">Période:</label>
    <select name="idperiode" id="idperiode">
        @foreach($calendrier as $periode)
            <option value="{{ $periode->id }}">{{ $periode->nom }}</option>
        @endforeach
    </select><br><br>


    <label for="datedebutr">Date de début:</label>
    <input type="date" name="datedebutr" id="datedebutr" placeholder="Date de début"><br><br>

    <label for="datefinr">Date de fin:</label>
    <input type="date" name="datefinr" id="datefinr" placeholder="Date de fin"><br><br>

    <label for="montantimmediat">Montant immédiat:</label>
    <input type="text" name="montantimmediat" id="montantimmediat" placeholder="Montant immédiat"><br><br>

    <button type="submit">Soumettre</button>
</form>
@endsection