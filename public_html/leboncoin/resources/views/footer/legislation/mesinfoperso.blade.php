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
            @foreach($particuliers as $particulier)
                @if ($particulier->idcompte == $compte->idcompte)
                    <div>Civilité : <p style="display:inline;">@if($particulier->civilite == true)Homme @else Femme @endif</p></div>
                    <div>Nom : <p style="display:inline;">{{$particulier->nomparticulier}}</p></div>
                    <div>Prenom : <p style="display:inline;">{{$particulier->prenomparticulier}}</p></div>
                    <?php
                        $date = new DateTime($particulier->datenaissanceparticulier);
                        $dateFormattee = $date->format('d-m-Y');
                    ?>
                    <div>Date de naissance : <p style="display:inline;">{{$dateFormattee}}</p></div>
                    <div>Téléphone : <p style="display:inline;">{{$particulier->numtelparticulier}}</p></div>
                @else 
                @endif
            @endforeach
            @foreach ($cartes as $carte)
                @if ($carte->idcompte == $compte->idcompte)
            @endforeach
        @else 
        @endif
    @endforeach
@else
<p>Vous devez être connecté pour accéder à ceci. <a href="connect">Se connecter</a></p>

@endauth

@endsection