
@extends('layouts.app')

@section('content')



<!-- tentative de recherche par location : -->
<h1>Combobox de Villes</h1>

<form action="/city" method="post">
    @csrf
            <label for="city-select">Sélectionnez une ville :</label>
            <select name="city" id="city-select">
                <option value="">--Choisir un ville--</option>
                @foreach($cities as $id => $city)
                    <option value="{{ $id }}">{{ $city }}</option>
                @endforeach
            </select>
        
            <button type="submit">Soumettre</button>
    
</form>
<!-- traitement de la recherche et affichage : -->
    








@endsection

