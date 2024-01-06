@extends('layouts.app')

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

<form method="POST" action="{{ route('payement', ['idannonce' => $idannonce]) }}">
    @csrf
    <input type="hidden" name="idannonce" value="{{ $idannonce ?? '' }}">
    <label for="numCarte">Numéro de Carte</label>
    <input type="tel" id="numCarte" name="numCarte" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}" required /><br><br>
    <!-- Ajoutez d'autres champs et le bouton de soumission ici -->
</form>

@endsection