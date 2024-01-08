@extends('layouts.app')

@section('content')

@auth
    <h1>Vos informations personelles</h1>
    <div>Voici les informations que nous avons à votre sujet :</div><br>
    @foreach($comptes as $compte)
        @if ($compte->idcompte == Auth::user()->compte->idcompte)
        <div>Adresse rue : <p style="display:inline;">{{$compte->adresseruecompte}}</p></div>
            @foreach($villes as $ville)
                @if ($ville->idville == $compte->idville)
                    <div>Adresse ville : <p style="display:inline;">{{$ville->nomville}}</p></div>
                @else 
                @endif
            @endforeach
            <div>Adresse Code Postal : <p style="display:inline;">{{$compte->adressecpcompte}}</p></div>
            <div>Email : <p style="display:inline;">{{$compte->email}}</p></div>
            <div>Pseudo : <p style="display:inline;">{{$compte->pseudo}}</p></div>
            <div>PDP : <p style="display:inline;">{{$compte->pdp}}</p></div>
            <div>SIRET : <p style="display:inline;">{{$compte->siret}}</p></div>
        @else 
        @endif
    @endforeach
@else
<p>Vous devez être connecté pour accéder à ceci. <a href="connect">Se connecter</a></p>

@endauth

@endsection